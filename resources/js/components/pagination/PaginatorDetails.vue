<template>
        <div>
            <small>Showing {{ results.from }} to 
                        {{ results.to   }} of     
                        {{ results.total}}
                | 
                Page {{ results.current_page }} of 
                     {{ results.last_page }} 
                </small>
        </div>
</template>

<script>
export default {
    props:['results']
}
</script>
<style  scoped>

</style>