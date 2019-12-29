$(function() {
	let ctx = [];
	let displayQuestion;
	let questionsData = [];

	function initQuestion() {
		$('.question .sentence').empty();
		$('.question .content').empty();

		let currentQuestion = questionsData.currentQuestion;
		let questions = questionsData.questions;

		switch(questions[currentQuestion].type) {
			case 'MultipleQuestion':
			handleQuestion = handleQCM;
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
		$.get('/exercises/template', function(response) {
			questionsData = response;

			let currentQuestion = questionsData.currentQuestion;
			let questions = questionsData.questions;

			initQuestion();
			handleQuestion();	

			$('.next-button').click(function() {
				if(questionsData.currentQuestion+1 < questions.length) {
					questionsData.currentQuestion++;
					$('.question').fadeOut(200, function() {
						initQuestion();
						handleQuestion();
						$(this).fadeIn(200);
					});
				} else {
					$('.question').fadeOut(200, function() {
						$('.next-button').hide();
						$('.question').html('<h1>EXERCICE TERMINÉ</h1>');
						$(this).fadeIn(200);

					// TODO: ENVOYER LES DONNEES AU SERVEUR
				});
				}
			});	
		});
	});

	function handleQCM() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('.question .sentence').text(question.sentence);
		$('.question .content').append('<ul class="choices"></ul>');
		question.choices.forEach((choice, index) => {
			$('.question .choices').append(`<li data-id="${index}">${choice}</li>`);
		});

		$('.question .choices').on('click', 'li', function() {
			let idChoice = $(this).attr('data-id');

			$('.question .choices li').removeClass('selected');
			$(this).addClass('selected');

			ctx[currentQuestion] = {
				id: question.id,
				type: question.type,
				choice: idChoice
			};
			console.log(ctx);
		})
	}

	function handleSimpleQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		let formattedSentence = question.sentence.replace('{word}', '<input type="text" class="word">');
		$('.question .sentence').html(formattedSentence);

		$('.word').keyup(function() {
			ctx[currentQuestion] = {
				id: question.id,
				type: question.type,
				word: $(this).val()
			}
		});

		console.log(ctx)
	}

	function handlePuzzleQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		$('.question .content').append('<div class="dropzone"></div>');
		$('.question .content').append('<div class="dragzone"></div>');

		let sentence = question.sentence;
		let positions = question.positions;
		let roles = question.roles;

		for(let i = 0; i < positions.length; i++) {
			$('.question .sentence').append(`<span class="sentence-part">${sentence.substr(positions[i][0], positions[i][1])}</span>`);
			$('.dropzone').append('<div class="box red droppable"></div>');
		}

		// hacky, à améliorer
		setTimeout(function() {
			for(let i = 0; i < positions.length; i++) {
				$('.dropzone .droppable').each(function(index) {
					let width = $($('.sentence-part').get(i)).width();
					console.log(i + ' => ' + width);
					$($('.dropzone .droppable').get(i)).width($($('.sentence-part').get(i)).outerWidth());
				});
			}
		}, 1);

		question.roles.forEach((role, index) => {
			$('.question .dragzone').append(`<div class="box red draggable" draggable="true" data-id="${index}">${role}</div>`);
		});

		let $draggable = $('.draggable');
		let $droppable = $('.droppable');
		let $dragzone = $($('.dragzone')[0]);

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
			$('.dragzone').append(dragElement);
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
			$('.dragzone').remove(dragElement);
			$(e.target).append(dragElement);
		});
	}

	function handleClickableQuestion() {
		let currentQuestion = questionsData.currentQuestion;
		let question = questionsData.questions[currentQuestion];

		let words = question.sentence.split(' ');
		words.forEach((word) => {
			$('.question .sentence').append(`<span>${word}</span> `);
		});

		$('.question .sentence>span')
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

			$('.question .sentence>span').css('border', 'none');

			$target.css({
				'border': '1px solid red',
				'border-radius': '10px',
				'padding': '5px 10px'
			});
		});
	}
});