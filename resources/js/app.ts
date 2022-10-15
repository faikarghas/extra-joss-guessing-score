import './bootstrap';

// Third Parties
import 'flowbite';

// Modules
import { Home } from './modules/home';

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

            const homePage = new Home();
            // Init all functionality
            homePage.init();
            homePage.guessModal();
            homePage.kirimForm();
            homePage.closeModal();
            homePage.closeModalLogin();
            homePage.loginModal();
            
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