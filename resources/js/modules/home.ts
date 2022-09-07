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
}

export function sum(a: number, b:number): number {
    return a + b;
}

