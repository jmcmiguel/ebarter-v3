<template>
    <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
            <div class="col-span-1 bg-white border-r border-gray-300">
                <div class="my-3 mx-3 ">
                    <div class="relative text-gray-600 focus-within:text-gray-400">
                         <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>

                            <input type="text" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-green-500 focus:outline-none focus:ring-0" placeholder="Search">
                        </div>
                </div>

                <ul class="overflow-auto" style="height: calc(100vh - 14.5rem);">
                    <li>
                        <conversation v-for="convo in conversations" :key="convo.id" :convo="convo"/>
                    </li>
                </ul>
            </div>
            <div class="col-span-2 bg-white">
                <div class="w-full">
                    <div class="flex items-center border-b border-gray-300 pl-3 py-3">
                        <img class="h-10 w-10 rounded-full object-cover"
                        src="https://images.pexels.com/photos/3777931/pexels-photo-3777931.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                        alt="username" />
                        <span class="block ml-2 font-bold text-base text-gray-600">Eduard</span>
                        <span class="connected text-green-500 ml-2" >
                            <svg width="6" height="6">
                                <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                            </svg>
                        </span>
                    </div>
                    <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: calc(100vh - 14.5rem);" ref="toolbarChat">
                        <ul>
                            <li class="clearfix2">
                                <div class="w-full flex justify-start">
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">Hello bro</span>
                                        <span class="block text-xs text-right">10:30pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-end" >
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">Hello</span>
                                        <span class="block text-xs text-left">10:32pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-end" >
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">how are you?</span>
                                        <span class="block text-xs text-left">10:32pm</span>
                                    </div>
                                </div>
                                <div class="w-full flex justify-start">
                                    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                        <span class="block">I am fine</span>
                                        <span class="block text-xs text-right">10:42pm</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
                        <button class="outline-none focus:outline-none">
                            <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                        <button class="outline-none focus:outline-none ml-1">
                            <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                        </button>

                        <input type="text" class="w-full py-2 pr-4 text-gray-700 bg-white border border-gray-300 rounded-xl focus:border-green-500 focus:outline-none focus:ring-0" placeholder="Type message here...">
                        
                        <button class="outline-none focus:outline-none" type="submit">
                            <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import Conversation from '@/Components/ChatConversation'

export default {

    props: ['conversations'],

    components:{
        Conversation
    },

    data(){
        return{
        }
    },

    mounted(){
    }
    
}
</script>