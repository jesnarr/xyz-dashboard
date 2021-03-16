<template>
<div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <!-- first page -->
              <li class="page-item"
               v-if="results.current_page > 2"
               @click.prevent="$emit('get-page', 1)">
                <a class="page-link" href="#"  >
                    <i class="fa fa-chevron-left"></i>
                    <i class="fa fa-chevron-left"></i>
                </a>
            </li>
            <!-- previous page-->
            <li class="page-item" 
            v-if="results.current_page > 1"
            @click.prevent="$emit('get-page', results.current_page - 1)">
               
                <a class="page-link" href="#" >
                    <i class="fa fa-chevron-left"></i>
                </a></li>


            <!-- numbers -->
                <li class="page-item"
                    v-if="results.current_page > 5"
                >
                    <span class="page-link">...</span>
                </li>

        <!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
                <li class="page-item"
                  v-for="num in results.last_page"
                  v-bind:key="num"
                  @click.prevent="$emit('get-page',num)"
                  v-if="num > results.current_page - 5 && num < results.current_page + 5"
                  :class="{active: num === results.current_page}"
                   >
                    <a href="#" class="page-link"  
                     >{{ num }}</a>
                </li>

              <li class="page-item"
                 v-if="results.current_page < results.last_page - 5"
              >
                    <span class="page-link">...</span>
                </li>
            <!-- end numbers -->

                <!-- next page-->
            <li class="page-item"
             v-if="results.current_page < results.last_page"
             @click.prevent="$emit('get-page', results.current_page + 1)">
                <a class="page-link" href="#" >
                    <i class="fa fa-chevron-right"></i>
            </a></li>
            <!-- last page -->
            <li class="page-item" 
            v-if="results.current_page < results.last_page - 1"
            @click.prevent="$emit('get-page', results.last_page)">
                <a class="page-link" href="#"  >
                    <i class="fa fa-chevron-right"></i>
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
           
        </ul>
    </nav>
</div>
</template>

<script>
export default {
    props:['results'],

}
</script>

<style scoped>

</style>