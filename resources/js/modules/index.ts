let base_url = window.location.origin;

let bankQuiz = [
    {
        id:1,
        pertanyaan:'Siapa pencetak goal terbanyak di piala dunia 2002?',
        jawaban:{
            a:'faikar1',
            b:'faikar2',
            c:'faikar3',
            d:'faikar4'
        }
    },
    {
        id:2,
        pertanyaan:'Siapa pencetak goal terbanyak di piala dunia 2006?',
        jawaban:{
            a:'faikar1',
            b:'faikar2',
            c:'faikar3',
            d:'faikar4'
        }
    },
    {
        id:3,
        pertanyaan:'Siapa pencetak goal terbanyak di piala dunia 2010?',
        jawaban:{
            a:'faikar1',
            b:'faikar2',
            c:'faikar3',
            d:'faikar4'
        }
    }
]

export class Auth {

    closeModalLogin(): void {
        $('.close-login').on('click',function () {
            // close modal
            $('.modal-login').css('display','none')

        })
    }

    closeModalRegister(): void {
        $('.close-register').on('click',function () {
            // close modal
            $('.modal-register').css('display','none')

        })
    }

    openLoginModal(): void{
        $('.log').on('click',function () {
            $('.modal-login').css('display','block')
        })
    }

    openRegisterModal(): void{
        $('.reg').on('click',function () {
            $('.modal-register').css('display','block')
        })
    }

}

export class GuessScore {
    kirimForm(): void {
        $('.modal-form').on('click','button.kirim-tebakan',function (e) {
            e.preventDefault()
            $(this).html('Loading...')
            let id = $(this).attr('data-im');
            let guess_score_a = $(".form-tebak[name=guess_score_a]").val()
            let guess_score_b = $(".form-tebak[name=guess_score_b]").val()

            $.ajax({
                type:'POST',
                url:`${base_url}/guess-score/${id}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data  :{
                    'guess_score_a':guess_score_a,
                    'guess_score_b':guess_score_b
                },
                error: function(xhr, error){
                    if (xhr.status === 500) {
                        $('.kirim-tebakan').html('Gagal Terkirim')

                        setTimeout(() => {
                            $('.kirim-tebakan').html('Kirim')
                        }, 2500);
                    }
                },
                success:function(data){
                    $('.kirim-tebakan').html('Terkirim')
                    setTimeout(() => {
                        $('.kirim-tebakan').html('Kirim')
                    }, 2500);

                }
            });

            // alert(`${guess_score_a} ${guess_score_b}`)
        })
    }

    closeModal(): void {
        $('.modal-form').on('click','div.close',function () {
            // close modal
            $('.modal-form').css('display','none')

            // delete appended content from modal
            $('.form-wrapper').remove()
        })
    }

    openGuessModal(): void{
        $('.btn-tebak').each(function () {
            const $this = $(this);
            $this.on("click", function () {
                let id = $(this).attr('data-idMatch');
                let team1 = $(this).attr('data-team1');
                let team2 = $(this).attr('data-team2');
                let flagteam1 = $(this).attr('data-flag1');
                let flagteam2 = $(this).attr('data-flag2');


                $('.modal-form').css('display','block')

                $('.modal-form').append(
                    `
                    <div class="form-wrapper flex flex-wrap">
                    <div class="close">
                        <div class="">
                            <img src="${base_url}/images/close.png" />
                        </div>
                    </div>
                    <div class="basis60">
                        <h2 class="text-[#FCEF0A] leading-[1] text-[40px] font-head mb-12">MASUKAN SKOR ANDA</h2>
                        <form class="">
                            <div class="flex items-center mb-4">
                                <div class="label">
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${flagteam1}" />
                                    <span class="text-white font-sans mr-6">${team1}</span>
                                </div>
                                <input class="form-tebak" type="number" name="guess_score_a"
                                value=""></input>
                            </div>
                            <div class="flex items-center mb-12">
                                <div class="label">
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${flagteam2}" />
                                    <span class="text-white font-sans mr-6">${team2}</span>
                                </div>
                                <input class="form-tebak" type="number" name="guess_score_b"
                                value=""></input>
                            </div>
                            <button data-im=${id} class="kirim-tebakan">Kirim</button>
                        </form>
                    </div>
                    <div class="basis40 flex items-end justify-end">
                        <div class="flex items-center">
                            <img class="mr-1" width="22px" src="${base_url}/images/acv.png" />
                            <span class="block text-white text-[24px] font-black font-sans">1.000 Poin</span>
                        </div>
                    </div>
                    </div>
                    `
                )
            });
        });
    }
}

export class Quiz{

    currentPage:number
    totalQuestion:number
    result: Array<any>

    constructor(currentPage:number,totalQuestion:number) {
        this.currentPage = currentPage;
        this.totalQuestion = totalQuestion;
        this.result = [];
    }

    closeQuizModal(): void{
        $('.modal-quiz .close').on('click',function () {
            // close modal
            $('.modal-quiz').css('display','none')
        })
    }

    openQuizModal(): void{
        $('.qz').on('click',function () {
            $('.modal-quiz').css('display','block')

            let question = bankQuiz[0]
            $('.modal-quiz').prepend(
                `
                <div class="quiz-wrapper flex flex-col">
                    <h3>${question.pertanyaan}</h3>
                    <div class="answer-box">
                        <fieldset>
                            <div class="choosebox">
                                <input id="country-option-1" type="radio" name="answer${question.id}" value=${question.jawaban.a} >
                                <label for="country-option-1" class="">${question.jawaban.a}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-2" type="radio" name="answer${question.id}" value=${question.jawaban.b} >
                                <label for="country-option-2" class="">${question.jawaban.b}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-3" type="radio" name="answer${question.id}" value=${question.jawaban.c} >
                                <label for="country-option-3" class="">${question.jawaban.c}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-4" type="radio" name="answer${question.id}" value=${question.jawaban.d} >
                                <label for="country-option-4" class="">${question.jawaban.d}</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                `
            )
        })
    }

    nextQuiz(): void{
        let cp = this.currentPage
        let tq = this.totalQuestion
        $('.modal-quiz').on('click','button.act-quiz',function (e) {

            if (cp >= tq - 1 ) return;

            if (cp == tq - 2) {
               $(this).addClass('send-answer')
               $(this).removeClass('act-quiz')
               $(this).html('Kirim')
               $(this).css('background-color','#FF0000')
            }

            cp = cp + 1
            let question = bankQuiz[cp]

            $('.quiz-wrapper').remove()
            $('.modal-quiz').prepend(
                `
                <div class="quiz-wrapper flex flex-col">
                    <h3>${question.pertanyaan}</h3>
                    <div class="answer-box">
                        <fieldset>
                            <div class="choosebox">
                                <input id="country-option-1" type="radio" name="answer${question.id}" value=${question.jawaban.a} >
                                <label for="country-option-1" class="">${question.jawaban.a}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-2" type="radio" name="answer${question.id}" value=${question.jawaban.b} >
                                <label for="country-option-2" class="">${question.jawaban.b}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-3" type="radio" name="answer${question.id}" value=${question.jawaban.c} >
                                <label for="country-option-3" class="">${question.jawaban.c}</label>
                            </div>

                            <div class="choosebox">
                                <input id="country-option-4" type="radio" name="answer${question.id}" value=${question.jawaban.d} >
                                <label for="country-option-4" class="">${question.jawaban.d}</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                `
            )
        })

    }

    storeCheckedInput(): void{
        $('.modal-quiz').on('click','input[type="radio"]', (e) => {
            this.result.push(
                {
                    id : $(e.currentTarget).attr('name')?.split('answer')[1],
                    answer: $(e.currentTarget).val()
                }
            )

            const filterById = [...new Map(this.result.map(item => [item['id'], item])).values()];

            this.result = filterById
        });
    }

    kirimJawabanQuiz(): void{
        $('.modal-quiz').on('click','button.send-answer', (e) => {
            console.log(this.result);
        })
    }
}

export function sum(a: number, b:number): number {
    return a + b;
}

