export default {
    data(){
        return {

        }
    },
    methods:{
            callApi(method, url, dataObj){
                try{
               return  axios({
                        method: method,
                        url:url,
                        data: dataObj
                    });

                }catch(err){
                    return err.response
                }
                   
            },
            info (desc, title="Hey") {
                this.$Notice.info({
                    title: title,
                    desc: desc
                });
            },
            success (desc, title="Great!") {
                this.$Notice.success({
                    title: title,
                    desc: desc
                  });
            },
            warning (desc, title="Ooops!") {
                this.$Notice.warning({
                    title: title,
                    desc: desc
                 });
            },
            error (desc, title="Ooops!") {
                this.$Notice.error({
                    title: title,
                    desc: desc
                 });
            },
            swr (desc="Something went wrong! Please try again.", title="Hey") {
                this.$Notice.error({
                    title: title,
                    desc: desc
                 });
            },
    },
}
