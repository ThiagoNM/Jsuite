export class AssetsList {


    assets;

    constructor() {

        this.assets = [];
        this.obtenirDades().then ((data) =>  { this.assets=data; console.log(data) } );

    }
    async obtenirDades()
    {

        let data1 = await fetch('https://biblioteca-9f853-default-rtdb.europe-west1.firebasedatabase.app/assets.json')
        data1 = await data1.json();
        
        
        return data1;
    }

}