import './bootstrap';

// Third Parties
import 'flowbite';

// Modules
import { Auth, Quiz, GuessScore } from './modules';

// Utils
import { getCurrentDate } from './utils/index';


(function(yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(jQuery, document);

    }(function($, document) {
        // The $ is now locally scoped
        $(function() {
            const Window = (window as any)

            // The DOM is ready!
            console.log('The DOM is ready!')

            /**
             * Home Modules
             */

            const auth = new Auth();
            const guess = new GuessScore();
            const quiz = new Quiz(0,2);

            // Init all functionality
            guess.openGuessModal();
            guess.tebakSkor();
            guess.closeModal();

            quiz.getQuiz()
            quiz.openQuizModal();
            quiz.kirimJawabanQuiz();
            quiz.nextQuiz();
            quiz.storeCheckedInput();
            quiz.closeQuizModal();

            console.log(
                Window.list
            );

            /**
             * About Modules
             */

        });
        console.log('The DOM may not be ready!')

        // The rest of your code goes here!

    }
));