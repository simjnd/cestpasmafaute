$(function() {
	let ctx = [];
	let displayQuestion;
	let questionsData = [];

	function initQuestion() {
		$('#question').empty();
		$('#question').append('<div id="question-content"></div>');
		$('#question #question-content').append('<p class="sentence"></p>');

		let currentQuestion = questionsData.currentQuestion;
		let questions = questionsData.questions;

		switch(questions[currentQuestion].type) {
			case 'MultipleQuestion':
			handleQuestion = handleMultipleQuestion;
			break;
			case 'SimpleQuestion':
			handleQuestion = handleSimpleQuestion;
			break;
			case 'PuzzleQuestion':
			handleQuestion = handlePuzzleQuestion;
			break;
			case 'ClickableQuestion':
			handleQuestion = handleClickableQuestion;
			break;
			default:
			console.log('Question non implémentée')
			break;
		}

		$('.id-question').text(currentQuestion+1);
	}

	$(document).ready(function() {
		$.get('/exercises/0', function(response) {
			questionsData = response;
			questionsData.currentQuestion = 0;

			let currentQuestion = questionsData.currentQuestion;
			let questions = questionsData.questions;

			initQuestion();
			handleQuestion();	

			$('.answer').click(function() {
				if(questionsData.currentQuestion+1 < questions.length) {
					questionsData.currentQuestion++;
					$('#question').fadeOut(200, function() {
						initQuestion();
						handleQuestion();
						$(this).fadeIn(200);
					});
				} else {
					$('#question').fadeOut(200, function() {
						$('.answer').hide();
						$('#question').html('<h1>EXERCICE TERMINÉ</h1>');
						$(this).fadeIn(200);

						console.log(ctx);
						// TODO: ENVOYER LES DONNEES AU SERVEUR
						$.post('/exercises/0', { context: ctx }, (response) => {
							$('#question').append(response);
						});
					});
				}
			});	
		});
	});

	function handleMultipleQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('#question #question-content .sentence').text(question.sentence);
		$('#question #question-content').append('<ul class="choices"></ul>');
		question.choices.forEach((choice, index) => {
			$('#question .choices').append(`<li data-id="${index}">${choice}</li>`);
		});

		$('#question .choices').on('click', 'li', function() {
			let choice = $(this).text()

			$('#question .choices li').removeClass('selected');
			$(this).addClass('selected');

			ctx[currentQuestion] = {
				id: question.id,
				type: question.type,
				choice: choice
			};
		})
	}

	function handleSimpleQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('#question').append('<div class="answer"><p>Valider</p></div>');

		let formattedSentence = question.sentence.replace('<cpmf>', '<input type="text" class="word">');
		$('#question .sentence').html(formattedSentence);

		$('.word').keyup(function() {
			ctx[currentQuestion] = {
				id: question.id,
				type: question.type,
				answer: $(this).val()
			}
		});
	}

	function handlePuzzleQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('#question').append('<div id="question-draggables"></div>');
		$('#question').append('<div class="answer"><p>Valider</p></div>');

		let sentence = question.sentence;
		let positions = question.positions;
		let roles = question.roles;

		for(let i = 0; i < positions.length; i++) {
			$('#question #question-content .sentence').append(`<span class="sentence-part">${sentence.substring(positions[i][0], positions[i][1])}</span>`);
			$('#question #question-content').append('<div class="placeholder droppable"></div>');
		}

		// hacky, à améliorer
		setTimeout(function() {
			for(let i = 0; i < positions.length; i++) {
				$('#question #question-content .droppable').each(function(index) {
					let width = $($('.sentence-part').get(i)).width();
					$($('#question #question-content .droppable').get(i)).css('min-width', ($($('.sentence-part').get(i)).outerWidth()) + 'px');
				});
			}
		}, 0);

		question.roles.forEach((role, index) => {
			$('#question #question-draggables').append(`<div class="draggable" draggable="true" data-id="${index}"><p>${role}</p></div>`);
		});

		let $draggable = $('.draggable');
		let $droppable = $('.droppable');
		let $dragzone = $($('#question-draggables')[0]);

		$draggable.on('dragstart', function(e) {
			dragElement = $(this);
		});

		$dragzone.on('dragover', function(e) {
			e.preventDefault();
		}).on('dragenter', function(e) {
			e.preventDefault();
		}).on('drop', function(e) {
			dragElement.css('margin', '50px');
			dragElement.detach();
			$('#question-draggables').append(dragElement);
		});

		$droppable.on('dragover', function(e) {
			e.preventDefault();
			$(this).css('background', 'rgba(150, 150, 150, .25)');
		}).on('dragleave dragexit', function(e) {
			$(this).css('background', 'white');
		}).on('dragenter', function(e) {
			e.preventDefault();
		}).on('drop', function(e) {
			if(typeof ctx[currentQuestion] === 'undefined') {
				ctx[currentQuestion] = {
					id: question.id,
					type: question.type,
					roles: []
				}
			}

			ctx[currentQuestion].roles[$(this).index()] = $(dragElement).attr("data-id");

			dragElement.css('margin', '0');
			$('#question-draggables').remove(dragElement);
			$(e.target).append(dragElement);
		});
	}

	function handleClickableQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('#question').append('<div class="answer"><p>Valider</p></div>');

		let words = question.sentence.split(' ');
		words.forEach((word) => {
			$('#question .sentence').append(`<span>${word}</span> `);
		});

		$('#question .sentence>span')
		.css('cursor', 'pointer')
		.on('click', (e) => {
			let $target = $(e.target);

			if(typeof ctx[currentQuestion] === 'undefined') {
				ctx[currentQuestion] = {
					id: question.id,
					type: question.type
				}
			}

			ctx[currentQuestion].clickedWord = $target.index();

			$('#question .sentence>span').css('border', 'none');

			$target.css({
				'border': '1px solid red',
				'border-radius': '10px',
				'padding': '5px 10px'
			});
		});
	}
});