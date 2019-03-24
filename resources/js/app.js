
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

Vue.component('message', require('./components/groupchat/message.vue').default);
Vue.component('userlist', require('./components/groupchat/userlist.vue').default);




const app = new Vue({
    el: '#app',
    data:{
        message:'',
        chatmessage:{
            message:[],
            user:[],
            color:[],
            time:[],
        },
        typing:'',
        listOfUsers:0,
        userlists:[],
    },
    watch:{
        message(){
            Echo.private('chatmessage')
            .whisper('typing', {
                name: this.message
            });
        }
    },
    methods: {
        send(){
            if(this.message.length != 0){
            this.chatmessage.message.push(this.message);
            this.chatmessage.color.push('success');
            this.chatmessage.user.push('you');
            this.chatmessage.time.push(this.getTime());

           /*  console.log(chatmessage);
 */
            axios.post('/sendmessage', {
                 chatmessage:this.message,

              })
              .then(response=> {
                console.log(response);
                this.message='';
              })
              .catch(function (error) {

              });
              axios.post('/saveMessage', {

                chatmessage:this.chatmessage,
             })
             .then(response=> {
               console.log(response);
               this.message='';
             })
             .catch(function (error) {

             });
          }
        },
        getTime()
        {
            let time = new Date();
            return time.getHours()+':'+time.getMinutes();
        },
        getMessages(){
            axios.post('/getMessage')
                  .then(response => {

                    if (response.data != '') {
                         this.chatmessage = response.data;
                    }
                  })
                  .catch(error => {
                    console.log(error);
                  });
        },
        clearchat(){
            axios.post('/claerChat')
            .then(response=> this.$toaster.success('Chat History Deleted')/* ,location.reload() */);
        }


    },
    mounted(){
         this.getMessages();
         Echo.private('chatmessage')
        .listen('groupevent', (e) => {
         this.chatmessage.message.push(e.chatmessage);
         this.chatmessage.user.push(e.user);
         this.chatmessage.color.push('primary');
         this.chatmessage.time.push(this.getTime());
         axios.post('/saveMessage', {

            chatmessage:this.chatmessage,
         })

        })

        .listenForWhisper('typing', (e) => {
            if(e.name !='')
            {
                this.typing='typing....'
            }else{
                this.typing=''
            }

      });
      Echo.join('chatmessage')
    .here((users) => {


      this.listOfUsers= users.length;
      this.userlists= users;

    })
    .joining((user) => {
        this.listOfUsers +=1;

        this.$toaster.success(user.name+' has joined.')
    })
    .leaving((user) => {
        this.listOfUsers -=1;
        this.$toaster.warning(user.name+' has left.')
    });
    }
});

Vue.component('chatapp', require('./components/privatechat/ChatApp.vue').default);
const app2 = new Vue({
    el: '#app2'
});
