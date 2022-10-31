let base_url = window.location.origin;

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
    filterInput(): void {
        const reg = new RegExp('^[0-9]+$');
        const invalidChars = ["-", "e", "+", "E",",","."];
        $('.modal-form').on('keydown','input', function (e) {
            if(invalidChars.includes(e.key)){
                e.preventDefault();
           }
        })

        $('.modal-form').on('paste','input',function (e) {
           e.preventDefault();
        })
    }

    tebakSkor(): void {
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
                    location.reload()
                }
            });

        })
    }

    closeModal(): void {
        $('.modal-form').on('click','div.close',function () {
            // close modal
            $('.modal-form').css('display','none')
            $('.overlay').css('display','none');

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
                let skor1 = $(this).attr('data-skor')?.split(',')[0];
                let skor2 = $(this).attr('data-skor')?.split(',')[1];

                $('.overlay').css('display','block');
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
                        <h2 class="text-black leading-[1] text-[40px] font-head mb-12">MASUKAN SKOR ANDA</h2>
                        <form class="">
                            <div class="flex items-center mb-4">
                                <div class="label">
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${flagteam1}" />
                                    <span class="text-black font-sans mr-6">${team1}</span>
                                </div>
                                <input value="${skor1}" min="0" class="form-tebak" type="number" name="guess_score_a"
                                value=""></input>
                            </div>
                            <div class="flex items-center mb-12">
                                <div class="label">
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${flagteam2}" />
                                    <span class="text-black font-sans mr-6">${team2}</span>
                                </div>
                                <input value="${skor2}" min="0" class="form-tebak" type="number" name="guess_score_b"
                                value=""></input>
                            </div>
                            <button data-im="${id}" class="kirim-tebakan">Kirim</button>
                        </form>
                    </div>
                    <div class="basis40 flex items-end justify-end">
                        <div class="flex items-center">
                            <img class="mr-1" width="22px" src="${base_url}/images/acv.png" />
                            <span class="block text-black text-[24px] font-black font-sans">1.000 Poin</span>
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
    listQuiz: Array<any>
    listOption: Array<any>


    constructor(currentPage:number,totalQuestion:number) {
        this.currentPage = currentPage;
        this.totalQuestion = totalQuestion;
        this.result = [];
        this.listQuiz = [];
        this.listOption = [];
    }

    openQuizModal(): void{
        $('.tebak-quiz').on('click','.qz', () => {
            $('.qz').html('loading...');
            $('.overlay').css('display','block');
            $.ajax({
                type:'GET',
                url:`${base_url}/getquiz`,
                error: function(xhr, error){
                    if (xhr.status === 500) {
                    }
                },
                success:(data) => {
                    console.log(data);

                    $('.qz').html('lihat quiz');
                    $('.modal-quiz').css('display','block')

                    this.listQuiz = data.question
                    this.listOption = data.option

                    let question = this.listQuiz[0]
                    let option = this.listOption

                    $('.modal-quiz').prepend(
                        `
                        <div class="quiz-wrapper flex flex-col">
                            <h3>${question.question}</h3>
                            <div class="answer-box">
                            <fieldset>
                            </fieldset>
                            </div>
                        </div>
                        `
                    )

                    let filteredOption = option.filter((val,key)=>{
                        return val.question_id == question.id
                    })

                    filteredOption.forEach(val => {
                        $('.modal-quiz fieldset').append(`<div class="choosebox"><input id="country-option-1" data-qi=${val.question_id} type="radio" data-ch="${val.id}" name="answer${val.question_id}" value=${val.choice}><label for="country-option-1" class="">${val.choice}</label></div>`)
                    });
                }
            })

        })
    }

    openQuizModalDisabled(): void{
        $('.qz-disabled').on('click',function (params) {
            $('.overlay').css('display','block');
            $('.modal-quizDis').css('display','block')
        })
    }

    closeQuizModal(): void{
        $('.modal-quiz .close').on('click', () => {
            // close modal
            $('.modal-quiz').css('display','none')
            $('.overlay').css('display','none');

            $('.quiz-wrapper').remove()
            $('.quiz-reward').remove()
            $('.total-trueQuiz').remove()
            this.currentPage = 0
        })
    }

    closeQuizDisabledModal(): void{
        $('.modal-quizDis .close').on('click', () => {
            // close modal
            $('.modal-quizDis').css('display','none')
            $('.overlay').css('display','none');
        })
    }

    nextQuiz(): void{
        let cp = this.currentPage
        let tq = this.totalQuestion
        let lq = this.listQuiz
        let lo = this.listOption
        $('.modal-quiz').on('click','button.act-quiz', (e) => {

            if (cp >= tq - 1 ) return;

            if (cp == tq - 2) {
               $(e.target).addClass('send-answer')
               $(e.target).removeClass('act-quiz')
               $(e.target).html('Kirim')
               $(e.target).css('background-color','#FF0000')
            }

            cp = cp + 1
            let question = this.listQuiz[cp]
            let option = this.listOption

            $('.quiz-wrapper').remove()
            $('.modal-quiz').prepend(
                `
                <div class="quiz-wrapper flex flex-col">
                    <h3>${question.question}</h3>
                    <div class="answer-box">
                    <fieldset>
                    </fieldset>
                    </div>
                </div>
                `
            )

            let filteredOption = option.filter((val,key)=>{
                return val.question_id == question.id
            })

            filteredOption.forEach(val => {
                $('.modal-quiz fieldset').append(`<div class="choosebox"><input id="country-option-1" data-qi=${val.question_id} type="radio" data-ch="${val.id}" name="answer${val.question_id}" value=${val.choice}><label for="country-option-1" class="">${val.choice}</label></div>`)
            });
        })

    }

    storeCheckedInput(): void{
        $('.modal-quiz').on('click','input[type="radio"]', (e) => {
            this.result.push(
                {
                    id_question : $(e.currentTarget).attr('data-qi'),
                    id_choice : $(e.currentTarget).attr('data-ch'),
                    answer: $(e.currentTarget).val()
                }
            )

            const filterById = [...new Map(this.result.map(item => [item['id_choice'], item])).values()];

            this.result = filterById
        });
    }

    kirimJawabanQuiz(): void{
        $('.modal-quiz').on('click','button.send-answer', (e) => {
            let id = $(e.target).attr('data-id');
            $(e.target).html('Loading...')

            $.ajax({
                type:'POST',
                url:`${base_url}/store-quiz/${id}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data  :{
                    'result':this.result,
                },
                error: function(xhr, error){
                    if (xhr.status === 500) {
                        $(e.target).html('Gagal Terkirim')

                        setTimeout(() => {
                            $(e.target).html('Kirim')
                        }, 2500);
                    }
                },
                success:function(data){
                    console.log(data);
                    $(e.target).html('Terkirim')
                    $('.quiz-wrapper').remove();
                    $('.act-wrapper').remove();
                    $('.modal-quiz').append(
                        `
                            <h3 class="quiz-reward">Anda mendapatkan ${40*data.totalTrue} poin</h3>
                            <h3 class="total-trueQuiz">${data.totalTrue}/10 pertanyaan dijawab benar!</h3>
                        `
                    );

                    setTimeout(() => {
                        location.reload()
                    }, 2500);
                }
            });
        })
    }

    getQuiz(): void {

    }

}

export class Register{
    seletCity(): void{
        $('#provinsi').on('change', function () {
            console.log($(this).val());

            $.ajax({
                type:'POST',
                url:`${base_url}/selectCity/${$(this).val()}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                error: function(xhr, error){
                    if (xhr.status === 500) {
                    }
                },
                success:(response) => {
                    console.log(response);
                    $('#city').empty();
                    $.each(response, function (index, item) {
                        console.log(name);
                        $('#city').append(new Option(item.name, item.id))
                    })
                }
            })

        })
    }
}

export class Menu {
    openMenuMobile(): void {
        $('#menu-hamburger').on('click',function (e) {
            $('.menu-mobile').css('display','block')
            $('body').css('overflow','hidden')
        })
    }

    closeMenuMobile(): void {
        $('.menu-mobile .close').on('click',function (e) {
            $('.menu-mobile').css('display','none')
            $('body').css('overflow','auto')
        })
    }
}

export class Klasemen {
    offestLoad:number;
    currentRound:any;

    constructor(){
        this.offestLoad = 16
        this.currentRound = 5
    }

    loadMore(): void {
        $('.loadMore').on('click', (e) => {
            $(e.target).html('loading...')
            $.ajax({
                type:'GET',
                url:`${base_url}/klasemen/${this.offestLoad}/${this.currentRound}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                error: function(xhr, error){
                    if (xhr.status === 500) {
                        console.log(error);
                    }
                },
                success:(res)=>{
                    if (res.data.length < 16) {
                        // $(e.target).remove();
                    }

                    res.data.forEach((el,i) => {
                        let splitName = el.name.split(' ')
                        let initialName = '';
                        if(splitName.length>1) {
                            initialName = el.name.split(' ')[1].split('')[0]
                        }

                        $('.klasemen').append(`
                        <div class="flex items-center">
                            <span class="block font-sans font-bold text-[17px] mr-2 basis-[15%]">${i + 9}</span>
                            <div class="basis-[25%]">
                                <div class="w-[60px] h-[60px] bg-[#D6D6D8] rounded-full flex justify-center items-center mr-4">
                                    ${el.name.split('')[0]}${initialName}
                                </div>
                            </div>
                            <div class="flex flex-col basis-[55%]">
                                <span class="block font-sans font-bold text-[17px]">${el.name}</span>
                                <span class="block font-sans ">${this.getPoint(el)} points</span>
                            </div>
                        </div>
                        `)
                    });
                    $(e.target).html('Lihat Semua Leaderboard')
                }
            });

            this.offestLoad+=8

        })

    }

    onChangeSelect(): void{
        $('.select-putaran').on('change init', (e) => {
            let selectedOption = $(e.target).val();
            this.currentRound = $(e.target).val();


            $.ajax({
                type:'GET',
                url:`${base_url}/klasemen/0/${selectedOption}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                error: function(xhr, error){
                    if (xhr.status === 500) {
                        console.log(error);
                    }
                },
                success:(res) => {
                    $('.klasemen').empty()
                    this.offestLoad = 8
                    res.data.forEach((el,i) => {
                        let splitName = el.name.split(' ')
                        let initialName = '';
                        if(splitName.length>1) {
                            initialName = el.name.split(' ')[1].split('')[0]
                        }

                        $('.klasemen').append(`
                        <div class="flex items-center">
                            <span class="block font-sans font-bold text-[17px] mr-2 basis-[15%]">${i + 1}</span>
                            <div class="basis-[25%]">
                                <div class="w-[60px] h-[60px] bg-[#D6D6D8] rounded-full flex justify-center items-center mr-4">
                                    ${el.name.split('')[0]}${initialName}
                                </div>
                            </div>
                            <div class="flex flex-col basis-[55%]">
                                <span class="block font-sans font-bold text-[17px]">${el.name}</span>
                                <span class="block font-sans ">${this.getPoint(el)} points</span>
                            </div>
                        </div>
                        `)
                    });
                }
            });
        })
    }

    fetchKlasemenData(): void{
        $.ajax({
            type:'GET',
            url:`${base_url}/klasemen/0/5`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            error: function(xhr, error){
                if (xhr.status === 500) {
                    console.log(error);
                }
            },
            success:(res) => {
                if (res.data.length < 16) {
                    $('.loadMore').remove();
                }
                $('.klasemen').empty()
                this.offestLoad = 8
                res.data.forEach((el,i) => {
                    let splitName = el.name.split(' ')
                    let initialName = '';
                    if(splitName.length>1) {
                        initialName = el.name.split(' ')[1].split('')[0]
                    }
                    $('.klasemen').append(`
                    <div class="flex items-center">
                        <span class="block font-sans font-bold text-[17px] mr-2 basis-[15%]">${i + 1}</span>
                        <div class="basis-[25%]">
                            <div class="w-[60px] h-[60px] bg-[#D6D6D8] rounded-full flex justify-center items-center mr-4">
                                ${el.name.split('')[0]}${initialName}
                            </div>
                        </div>
                        <div class="flex flex-col basis-[55%]">
                            <span class="block font-sans font-bold text-[17px]">${el.name}</span>
                            <span class="block font-sans ">${el.total_point} points</span>
                        </div>
                    </div>
                    `)
                });
            }
        });
    }

    getPoint(el): any{
        let whichRound;
        if (this.currentRound == 5) {
            whichRound = el.total_point;
        }

        if (this.currentRound == 1) {
            whichRound = el.point_1;
        }

        if (this.currentRound == 2) {
            whichRound = el.point_2;
        }

        if (this.currentRound == 3) {
            whichRound = el.point_3;
        }

        if (this.currentRound == 4) {
            whichRound = el.point_4;
        }
        return whichRound
    }
}

export function sum(a: number, b:number): number {
    return a + b;
}



