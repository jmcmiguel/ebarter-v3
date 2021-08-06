<template>
    <app-layout>
      <chat :conversations="conversations"/>
    </app-layout>
</template>

<script>
  import AppLayout from '@/Layouts/AppLayout'
  import Chat from '@/Components/Chat'

  export default {
    props: ['conversations'],

    components:{
        AppLayout,
        Chat
    },

    data() {
      return {
      }
    },

    mounted(){
    }
  }
</script>