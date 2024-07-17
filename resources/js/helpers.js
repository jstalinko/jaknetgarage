export default {
    capitalizeWords: function (arr) {
        return arr.map(element => {
            return element.charAt(0).toUpperCase() + element.substring(1).toLowerCase();
        });
    },

    makeReadable: function (key) {
        return this.capitalizeWords(key.replaceAll('_', ' ').split(' ')).join(' ');
    },
    rupiah: function(angka){
        return "Rp. "+new Intl.NumberFormat("en-ID").format(
            angka
          );
    },
    imageUrl: function(url){
        if(url !== undefined)
        {
            if(url.match(/http/))
            {
                return url;
            }else{
                if(url.includes('assets'))
                    {
                        return url;
                    }else{
                        return '/storage/'+url;
                    }
            }
        }else{
            return url;
        }
    
    },
    autoDiscount: function(price)
    {
        price = parseInt(price);
        const discountPercentage = Math.floor(Math.random() * (30 - 20 + 1)) + 10;
        const discountAmount = (price * discountPercentage) / 100;
        const discountedPrice = price + discountAmount;
    
        return discountedPrice;
    },
    stripTags: function(string){
        if(string !== undefined) return string.replace(/(<([^>]+)>)/gi, "");
    },
    WaButton: function(Global,path){
        let waHttp = "https://wa.me/";
        let number = Global?.no_whatsapp ?? '081234567890';
        let text = Global?.wa_message ?? 'Hello';
        let link = Global?.base_url + path; 
        number.replace(/^08/,'628');
        let format = waHttp+number+"?text="+text+"%0A%0A%0A"+link;
        return format;
    }
}