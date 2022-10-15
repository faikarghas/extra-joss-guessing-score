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
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${team1?.toLowerCase()}.png" />
                                    <span class="text-white font-sans mr-6">${team1}</span>
                                </div>
                                <input class="form-tebak" type="number" name="guess_score_a"
                                value=""></input>
                            </div>
                            <div class="flex items-center mb-12">
                                <div class="label">
                                    <img class="mr-3" width="32px" src="${base_url}/images/countries/${team2?.toLowerCase()}.png" />
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

    kirimForm(): void {
        $('.modal-form').on('click','button.kirim-tebakan',function (e) {
            e.preventDefault()
            $(this).html('Loading...')
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
                error: function(xhr, error){
                    // console.debug(xhr); console.debug(error);
                    if (xhr.status === 500) {
                        $('.kirim-tebakan').html('Gagal Terkirim')

                        setTimeout(() => {
                            $(this).html('Kirim')
                        }, 2500);
                    }
                },
                success:function(data){
                    $(this).html('Terkirim')

                    setTimeout(() => {
                        $(this).html('Kirim')
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

    closeModalLogin(): void {
        $('.close-login').on('click',function () {
            // close modal
            $('.modal-login').css('display','none')

        })
    }

    loginModal(): void{
        $('.log').on('click',function () {
            $('.modal-login').css('display','block')
        })
    }

}

export function sum(a: number, b:number): number {
    return a + b;
}

