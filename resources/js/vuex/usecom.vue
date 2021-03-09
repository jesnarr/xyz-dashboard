<template>
    <div>
<div class="content">
	<div class="container-fluid">
        <h1>Master Components</h1>
        <!-- Current state of counter is : {{$store.state.counter}} -->
        <h2>Master component {{ counter }}</h2>

        <div>
            <comA></comA>
            <comB></comB>
            <comC></comC>
        </div>

        <Button type="info" @click="changeCounter">Change the state</Button>
    </div>
</div>
</div>
</template>

<script>
import comA from './comA';
import comB from './comB';
import comC from './comC';

import { mapGetters } from 'vuex';

export default {
    data(){
        return {
            localVar: 'something'
        }
    },
    components: {
        comA,
        comB,
        comC
    },
    computed:{
        // ...mapGetters(['getCounter']) //get counter from store.js
        ...mapGetters({
            'counter':'getCounter'
        })
    },
    methods: {
    
        changeCounter(){
            // this.$store.state.counter++; //1st or
            // this.$store.commit('changeTheCounter',1);

            // actions
            this.$store.dispatch('changeCounterAction', 1);
        },
        runSomethingWhenCounterChange(){
            console.log('im running');
        }
    },
    watch: { //use to watch for changes
        counter(value){
            console.log('counter is changing', value);
            this.runSomethingWhenCounterChange();
            console.log('local var', this.localVar);
        }
    }
}
</script>