<?php
namespace CPMF\Controller;

use \CPMF\Models\StudentManager;
use \CPMF\Models\StudentExerciseManager;
use \CPMF\Models\GroupManager;
use \CPMF\Models\DecorationManager;

class StudentController extends Controller
{
    public function seeHomePage(): void
    {
        $validated = $_SESSION['validated'] ?? NULL;
        if ($validated) {
            $steps = StudentExerciseManager::getStepsByStudentID($_SESSION['idLogin']);
            $student = StudentManager::getByID($_SESSION['idLogin']);
            $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);

            parent::view('student-home', ['steps' => $steps, 'student' => $student, 'totalPoints' => $totalPoints]);
        } else {
            parent::view('student-home-validation');    
        }
    }

    public function seeClass(): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $class = GroupManager::getByID($student->getIdClass());
        $classmates = GroupManager::getStudents($student->getIdClass());

        parent::view('student-see-class', ['student' => $student, 'class' => $class, 'classmates' => $classmates]);
    }

    public function seeProfile(): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $student->fill();

        parent::view('student-profile', ['student' => $student, 'class' => $student->getGroup(), 'frames' => $frames, 'protraits' => $portraits, 'accessories' => $accessories]);
    }

    public function seeStep(int $id): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $step = StudentExerciseManager::getStepByID($id);
        $step->fillLessons();
        $lessons = $step->getLessons();
        $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);
        $group = GroupManager::getByID($student->getIdClass());
        parent::view('student-step', ['student' => $student, 'step' => $step, 'lessons' => $lessons, 'totalPoints' => $totalPoints, 'group' => $group]);
    }

    public function seeExercise(int $idStep, int $idDifficulty): void
    {
        $step = StudentExerciseManager::getStepByID($idStep);
        $step->fillExercises();
        $exercises = $step->getExercises();
        print_r($exercises);
        foreach ($exercises as $exercise) {
            if ($exercise->getDifficulty() === $idDifficulty) {
                $exercise->fill(); // Récupère toutes les questions de l'Exercise
                // Transférer les valeurs vers la vue qui gère les vues de tous les types de question
            }
            exit;
        }
    }

    public function postExercise(): void 
    {
        $infos = $_POST;

        //$recquiredValue = ?;

        if ($infos['nbPoints'] > $recquiredValue) {
            StudentExerciseManager::hasCompleted($infos['idLogin'], $infos['idExercise']);
            parent::redirect('/');
        } else {
            parent::redirect('/');
        }
    }

    // DEBUG (TEMPORAIRE)
    public function getExerciseData(int $idExercise) {
        $exercise = StudentExerciseManager::getExerciseById($idExercise, true);

        header('Content-type: application/json; charset=utf-8');

        $questions = ['questions' => []];

        // echo '<pre>';
        // print_r($exercise->getQuestions());
        // echo '</pre>';

        foreach($exercise->getQuestions() as $question) {
            if ($question instanceof \CPMF\Models\Entities\ClickableQuestion) {
                $questions['questions'][] = [
                    'id' => $question->getIdQuestion(),
                    'type' => 'ClickableQuestion',
                    'sentence' => $question->getSentence()
                ];
            } elseif ($question instanceof \CPMF\Models\Entities\MultipleQuestion) {
                $choices = [];
                foreach($question->getChoices() as $choice) {
                    $choices[] = $choice->getLabel();
                }

                $questions['questions'][] = [
                    'id' => $question->getIdQuestion(),
                    'type' => 'MultipleQuestion',
                    'sentence' => $question->getSentence(),
                    'choices' => $choices
                ];
            } elseif ($question instanceof \CPMF\Models\Entities\PuzzleQuestion) {
                $roles = [];
                $positions = [];

                foreach($question->getRoles() as $role) {
                    $roles[] = $role->getLabel();
                    $positions[] = [$role->getStartMarker(), $role->getEndMarker()];
                }

                $questions['questions'][] = [
                    'id' => $question->getIdQuestion(),
                    'type' => 'PuzzleQuestion',
                    'sentence' => $question->getSentence(),
                    'positions' => $positions,
                    'roles' => $roles
                ];
            } elseif ($question instanceof \CPMF\Models\Entities\SimpleQuestion) {
                $wordToWrite = $question->getWordToWrite();
                $sentence = $question->getSentence();

                $sentence = str_replace('<cpmf>', '<cpmf> '.$wordToWrite, $sentence);
                $questions['questions'][] = [
                    'id' => $question->getIdQuestion(),
                    'type' => 'SimpleQuestion', 
                    'sentence' => $sentence
                ];
            }
        }

        echo json_encode($questions);
    }

    public function getTemplateExercises(): void
    {
        header('Content-type: application/json; charset=utf-8');

        $questions = [
            'questions' => [
                [
                    'id' => 4,
                    'type' => 'ClickableQuestion',
                    'sentence' => 'Clique sur le troisième mot'
                ],
                [
                    'id' => 3,
                    'type' => 'PuzzleQuestion',
                    'sentence' => 'Je suis là pour vous jouer un mauvais tour',
                    'positions' => [
                        [0, 10],
                        [10, 20],
                        [29, 41]
                    ],
                    'roles' => [
                        'Adj',
                        'Adverbe',
                        'Complément'
                    ]
                ],
                [
                    'id' => 1,
                    'type' => 'MultipleQuestion',
                    'sentence' => 'Les pommes que nous avons [...]',
                    'choices' => [
                        'mangé',
                        'mangés',
                        'manger',
                        'mangées'
                    ]
                ],
                [
                    'id' => 2,
                    'type' => 'SimpleQuestion',
                    'sentence' => 'Ils <cpmf> (manger) à Burger King',
                ]
            ]   
        ];

        echo json_encode($questions);
    }
}
