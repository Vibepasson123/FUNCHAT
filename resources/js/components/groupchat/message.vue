<template>
<div class="chatpad">
 <li class="list-group-item" :class="className"><slot></slot></li>

   <small class="badge float-right" :class="badgeClass">{{user}} <span id="msgtime">{{ time }}</span></small>

</div>

</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time'
        ],
        computed:{
            className(){
                return 'list-group-item-'+this.color;
            },
            badgeClass(){
                return 'badge-'+this.color;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>

  #msgtime{
  font-size:8px;
  margin-top:50%;
  margin-left:10px;
  color: #000000;
  font-weight:bold;
 }

</style>
