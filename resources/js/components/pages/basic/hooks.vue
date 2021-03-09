<template>
    <div>
        <h1 ref="myref">Hooks tutorial</h1>
        <h2>My name is {{ name }} </h2>
    </div>
</template>

<script>
export default {
    data(){
        return {
            name: 'Jesnar Erpe' 
        }
    },

    beforeCreate(){
            console.log(this.name);
    },

    // componentDidMount
    // before rendering html created is already available
    // cannot access html
    created(){
        // call mostly initial data from it
        console.log('data and other function is available but not html', this.name);
    },
    // after rendering all html mounted is now available
    // can access html
    mounted(){
        console.log(this.$refs.myref)
    }
}
</script>