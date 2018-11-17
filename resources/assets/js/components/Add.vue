<template>
	<div class="modal" :class='openmodal'>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
      <button class="delete" aria-label="close" @click='close'></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
  <label class="label">Username</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input is-success" :class="{'is-danger':errors.name}" type="text" placeholder="Enter name" value="" name="name" v-model="list.name">
    <span class="icon is-small is-left">
      <i class="fas fa-user"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
  </div>
  <p v-if="errors.name" class="help is-danger">{{errors.name[0]}}</p>
</div>

 <div class="field">
  <label class="label">Email</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input is-success" :class="{'is-danger':errors.email}" type="email" placeholder="Enter Email" value="" name="email" v-model="list.email">
    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
  </div>
 <p v-if="errors.email" class="help is-danger">{{errors.email[0]}}</p>
</div>

 <div class="field">
  <label class="label">phone</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input is-success" :class="{'is-danger':errors.phone}" type="text" placeholder="Enter number" value="" name="phone" v-model="list.phone">
    <span class="icon is-small is-left">
      <i class="fas fa-phone"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
  </div>
 <p v-if="errors.phone" class="help is-danger">{{errors.phone[0]}}</p>
</div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click='save'>Save changes</button>
      <button class="button" @click='close'>Cancel</button>
    </footer>
  </div>
</div>
</template>

<script>
  export default{
    props:['openmodal'],
    
    data(){
      return{
        list:{
          name:'',
          phone:'',
          email:''
        },
        errors:{

        }
      }
    },
    methods:{
      close(){
        this.$emit('closeReuest')
      },
      save(){
        axios.post('/phonebook',this.$data.list).then((response)=>{ 
          this.close() 
          this.$parent.lists.push(this.$data.list)
          this.$parent.lists.sort(function (a,b) {
            if(a.name>b.name){
              return 1;
            }
            else if(a.name<b.name){
              return -1;
            }
          })
          this.list=""
        })
  .catch((error) => this.errors=error.response.data.errors)
      }
    }

  }
</script>