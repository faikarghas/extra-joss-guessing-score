let base_url = window.location.origin;

export class Home {

    init(): void {
        this.logTest();
    }

    // console log test
    logTest(): void {
        $('.test').on('click', function (params:any) {
            console.log('test');
        })
    }

    guessModal(): void{
        $('.btn-tebak').each(function () {
            const $this = $(this);
            $this.on("click", function () {
                let id = $(this).attr('data-idMatch');
                let team1 = $(this).attr('data-team1');
                let team2 = $(this).attr('data-team2');

                $('.modal-form').css('display','block')

                $('.modal-form').append(
                    `
                    <div class="form-wrapper flex flex-wrap">
                    <div class="close top-[18px] right-[18px] absolute">
                        <div class="w-[44px] h-[44px] bg-white rounded-full flex items-center justify-center cursor-pointer">
                            <img src="${base_url}/images/close.png" />
                        </div>
                    </div>
                    <div class="basis-[60%]">
                        <h2 class="text-[#FCEF0A] leading-[1] text-[40px] font-head mb-12">MASUKAN SKOR ANDA</h2>
                        <form class="">
                            <div class="flex items-center mb-4">
                                <img class="mr-3" width="32px" src="${base_url}/images/countries/${team1?.toLowerCase()}.png" />
                                <span class="text-white font-sans mr-6">${team1}</span>
                                <input class="form-tebak bg-transparent border-[#383838] text-white py-1 h-[32px] w-full lg:w-[130px] rounded-3xl" type="number" name="guess_score_a"
                                value=""></input>
                            </div>
                            <div class="flex items-center mb-12">
                                <img class="mr-3" width="32px" src="${base_url}/images/countries/${team2?.toLowerCase()}.png" />
                                <span class="text-white font-sans mr-6">${team2}</span>
                                <input class="form-tebak bg-transparent border-[#383838] text-white py-1 h-[32px] w-full lg:w-[130px] rounded-3xl" type="number" name="guess_score_b"
                                value=""></input>
                            </div>
                            <button data-im=${id} class="kirim-tebakan text-white bg-gradient-to-r rounded-3xl w-full bg-[#A0A0A0] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium text-sm px-5 py-2.5 text-center">Kirim</button>
                        </form>
                    </div>
                    <div class="basis-[40%] flex items-end justify-end">
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

    kirimForm(): void {
        $('.modal-form').on('click','button.kirim-tebakan',function (e) {
            e.preventDefault()

            let id = $(this).attr('data-im');
            let guess_score_a = $(".form-tebak[name=guess_score_a]").val()
            let guess_score_b = $(".form-tebak[name=guess_score_b]").val()

            $.ajax({
                type:'POST',
                url:`http://127.0.0.1:8000/guess-score/${id}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data  :{
                    'guess_score_a':guess_score_a,
                    'guess_score_b':guess_score_b
                },
                success:function(data){
                   console.log(data);
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

}

export function sum(a: number, b:number): number {
    return a + b;
}

