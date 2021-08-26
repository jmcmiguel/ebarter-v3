<template>
  <app-layout>
     <main class="profile-page">
      <section class="relative block" style="height: 500px;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style='background-image: url("/img/default-cover.jpg");'>
          <span id="blackOverlay" class="w-full h-full absolute opacity-25 bg-black"></span>
        </div>
      </section>
      <section class="relative py-16">
        <div class="container mx-auto px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
            <div class="px-6">
              <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                  <div class="relative">
                    <img
                      alt="..."
                      :src="getProfilePhoto()"
                      class="shadow-xl rounded-full h-36 align-middle border-none absolute -m-16 -ml-20 lg:-ml-16"
                      style="max-width: 150px;"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                  <div class="py-6 px-3 mt-32 sm:mt-0">
                    <button
                      class="bg-green-500 active:bg-green-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1"
                      type="button"
                      style="transition: all 0.15s ease 0s;"
                    >
                      Give Ratings!
                    </button>
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-1">
                  <div class="flex justify-center py-4 lg:pt-4 pt-8">
                    <div class="mr-4 p-3 text-center">
                      <span class="text-xl font-bold block uppercase tracking-wide text-gray-700">{{ userPosts.length }}</span>
                      <span class="text-sm text-gray-500">Posts</span>
                    </div>
                    <div class="lg:mr-4 p-3 text-center">
                      <span class="text-xl font-bold block uppercase tracking-wide text-gray-700">89</span>
                      <span class="text-sm text-gray-500">Ratings</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center mt-12">
                <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2">
                  {{ user.name }}
                </h3>
                <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                  <img src="/img/map-pin.svg" class="inline">
                  &nbsp;
                  {{ `${user.city} City` }}
                </div>
                <div class="mb-2 text-gray-700">
                   <img src="/img/phone.svg" class="inline">
                  &nbsp;
                   {{ user.contact_number }}
                </div>
                <div class="mb-2 text-gray-700">
                  <img src="/img/mail.svg" class="inline">
                  &nbsp;
                   {{ user.email }}
                </div>
              </div>
              <div class="mt-10 py-10 border-t border-gray-300 text-center">
                <div class="flex flex-wrap justify-center">
                  <div class="w-full lg:w-9/12 px-4">
                    <p class="mb-4 text-lg leading-relaxed text-gray-800">
                      {{ user.bio }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- All Posts -->
        <div v-if="posts.data.length" class="p-6">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <post-card v-for="post in posts.data" :key="post.id" :id="post.id" :title="post.title" :description="post.description" :showEditPostModal="showEditPostModal"
                                :price="post.est_price" :views="post.views" :preferredItem="post.preferred_prod" :status="post.status" :userID="post.user_id" :showRejectOfferModal="showRejectOfferModal"
                                :prodName="post.prod_name" :qty="post.prod_qty" :qtyType="post.qty_type" :dateProduced="post.date_produced" :showDeletePostModal="showDeletePostModal"
                                :dateExpiree="post.date_expiree" :category="post.category" :datePosted="post.created_at" :showOffersModal="showOffersModal" :addToCart="addToCart" />
                </div>
            </div>
            <pagination :links="posts.links" />
        </div>
      <!-- Show if no posts found -->
        <div v-else class="flex justify-center flex-col mt-10 mb-20">
            <img class="h-72" src="/img/void.svg" alt="">
            <div class="mx-auto">
            no posts found
            </div>
        </div>

      <!-- Edit Post Modal -->
      <edit-post-modal :postData="editPostData" :showingEditModal="showingEditModal" :closeEditPostModal="closeEditPostModal" />

      <!-- Delete Post Modal -->
      <delete-post-modal :postData="deletePostData" :showingDeletePostModal="showingDeleteModal" :closeDeletePostModal="closeDeletePostModal" />

      <!-- Show Offers Modal -->
      <show-offers-modal :showingOffersModal="showingOffersModal" :closeOffersModal="closeOffersModal" :post="showingOffersData" />

      <!-- Reject Offer Modal -->
      <reject-offer-modal :show="showingRejectOfferModal" :close="closeRejectOfferModal" :offerID="rejectOfferData"/>

    </main>

  </app-layout>
</template>

<script>
  import AppLayout from '@/Layouts/AppLayout'
  import UserServices from '@services/User'
  import PostServices from '@services/Post'
  import PostCard from '@/Components/PostCard'
  import Pagination from '@/Components/Pagination'
  import ShowOffersModal from '@/Components/ShowOffersModal'
  import EditPostModal from '@/Components/EditPostModal'
  import DeletePostModal from '@/Components/DeletePostModal'
  import RejectOfferModal from '@/Components/RejectOfferModal'

  export default {
  
    components: {
      AppLayout,
      PostCard,
      Pagination,
      ShowOffersModal,
      EditPostModal,
      DeletePostModal,
      RejectOfferModal
    },

    props: ['posts', 'id'],

    data(){
      return {
        userPosts: [],
        user: {},
        showingOffersModal: false,
        showingEditModal: false,
        editPostData: null,
        showingDeleteModal: false,
        deletePostData: null,
        showingOffersData: null,
        showingRejectOfferModal: false,
        rejectOfferData: null,
      }
    },

    created() {
      this.getUser()
      this.getUserPosts()
    }, 

    methods:{
        showRejectOfferModal(offerID){
            this.rejectOfferData = offerID
            console.log(offerID)
            this.showingRejectOfferModal = true
        },

        closeRejectOfferModal(){
            this.showingRejectOfferModal = false
            this.closeOffersModal()
        },

        addToCart(postID){
          const form = this.$inertia.form({
              'post_id': postID
          })

          form.post(route('cart.store'), {
              preserveScroll: true,
              onSuccess: () => form.reset(),
              onError: () => this.$refs.post_title.focus(),
              onFinish: () => form.reset(),
          })
      },

      showOffersModal(postID, postTitle) {
          this.showingOffersData = {id: postID, title: postTitle}
          this.showingOffersModal = true
      },

      closeOffersModal() {
          this.showingOffersModal = false
      },

      showEditPostModal(postData) {
          this.editPostData = postData
          this.showingEditModal = true
      },

      closeEditPostModal() {
          this.showingEditModal = false
      },

      showDeletePostModal(id, title){
          this.deletePostData = {id: id, title: title}
          this.showingDeleteModal = true
      },
      
      closeDeletePostModal(){
          this.showingDeleteModal = false
      },

      getProfilePhoto() {
        if(this.user.profile_photo_path){
          return `/storage/${this.user.profile_photo_path}` 
        }else{
          return `https://ui-avatars.com/api/?name=${this.user.name}&color=059669&background=ECFDF5&size=512`
        }
      },

      async getUser() {
        this.user = await UserServices.getUser(this.id)
      },

      async getUserPosts() {
        this.userPosts = await PostServices.getUserPosts(this.id)
      },
    }

  }
</script>