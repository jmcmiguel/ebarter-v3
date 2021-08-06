<template>
	<div class="window-container" :class="{ 'window-mobile': isDevice }">

		<chat-window
			:height="screenHeight"
			:theme="theme"
			:styles="styles"
			:current-user-id="currentUserId"
			:rooms="room"
			:messages="messages"
		>
		</chat-window>
	</div>
</template>

<script>
import ChatWindow from '@/Components/Chat/ChatWindow'

export default {
	components: {
		ChatWindow
	},

	props: {
		currentUserId: { type: String, required: true },
		theme: { type: String, required: true },
		isDevice: { type: Boolean, required: true },
        room: { type: Array},
        messages: { type: Array}
	},

	emits: ['show-demo-options'],

	data() {
		return {
			roomsPerPage: 15,
			rooms: [],
			roomId: '',
			startRooms: null,
			endRooms: null,
			roomsLoaded: true,
			loadingRooms: false,
			allUsers: [],
			loadingLastMessageByRoom: 0,
			roomsLoadedCount: false,
			selectedRoom: null,
			messagesPerPage: 20,
			messages: [],
			messagesLoaded: false,
			roomMessage: '',
			startMessages: null,
			endMessages: null,
			roomsListeners: [],
			listeners: [],
			typingMessageCache: '',
			disableForm: false,
			addNewRoom: null,
			addRoomUsername: '',
			inviteRoomId: null,
			invitedUsername: '',
			removeRoomId: null,
			removeUserId: '',
			removeUsers: [],
			roomActions: [
				{ name: 'inviteUser', title: 'Invite User' },
				{ name: 'removeUser', title: 'Remove User' },
				{ name: 'deleteRoom', title: 'Delete Room' }
			],
			menuActions: [
				{ name: 'inviteUser', title: 'Invite User' },
				{ name: 'removeUser', title: 'Remove User' },
				{ name: 'deleteRoom', title: 'Delete Room' }
			],
			styles: { container: { borderRadius: '4px' } }
		}
	},

	computed: {
		loadedRooms() {
			return this.rooms.slice(0, this.roomsLoadedCount)
		},
		screenHeight() {
			return this.isDevice ? window.innerHeight + 'px' : 'calc(100vh - 80px)'
		}
	},

	mounted() {
		this.fetchRooms()
		this.updateUserOnlineStatus()
	},

	methods: {
		resetRooms() {
			this.loadingRooms = true
			this.loadingLastMessageByRoom = 0
			this.roomsLoadedCount = 0
			this.rooms = []
			this.roomsLoaded = true
			this.startRooms = null
			this.endRooms = null
			this.roomsListeners.forEach(listener => listener())
			this.roomsListeners = []
			this.resetMessages()
		},

		resetMessages() {
			this.messages = []
			this.messagesLoaded = false
			this.startMessages = null
			this.endMessages = null
			this.listeners.forEach(listener => listener())
			this.listeners = []
		},

		fetchRooms() {
			this.resetRooms()
			this.fetchMoreRooms()
		},

		async fetchMoreRooms() {
			if (this.endRooms && !this.startRooms) return (this.roomsLoaded = true)

            // @todo execute query to get rooms
			let query = ""

		},

		listenLastMessage(room) {
		},

		formatLastMessage(message) {
		},

		formatTimestamp(date, timestamp) {
		},

		fetchMessages({ room, options = {} }) {
		},

		listenMessages(messages, room) {
		},

		markMessagesSeen(room, message) {
		},

		formatMessage(room, message) {
		},

		async sendMessage({ content, roomId, file, replyMessage }) {
		},

		openFile({ message }) {
		},

		async openUserTag({ user }) {
		},

		async loadRoom(query) {
		},

		async editMessage({ messageId, newContent, roomId, file }) {
		},

		async deleteMessage({ message, roomId }) {
		},

		async uploadFile({ file, messageId, roomId }) {
		},

		menuActionHandler({ action, roomId }) {
		},

		async sendMessageReaction({ reaction, remove, messageId, roomId }) {
		},

		typingMessage({ message, roomId }) {
		},

		async listenRooms(query) {
		},

		updateUserOnlineStatus() {
		},

		listenUsersOnlineStatus(rooms) {
		},

		addRoom() {
		},

		async createRoom() {
		},

		inviteUser(roomId) {
		},

		async addRoomUser() {
		},

		removeUser(roomId) {
		},

		async deleteRoomUser() {
		},

		async deleteRoom(roomId) {
		},

		resetForms() {
			this.disableForm = false
			this.addNewRoom = null
			this.addRoomUsername = ''
			this.inviteRoomId = null
			this.invitedUsername = ''
			this.removeRoomId = null
			this.removeUserId = ''
		}

	}
}
</script>

<style lang="scss" scoped>
.window-container {
	width: 100%;
}

.window-mobile {
	form {
		padding: 0 10px 10px;
	}
}

form {
	padding-bottom: 20px;
}

input {
	padding: 5px;
	width: 140px;
	height: 21px;
	border-radius: 4px;
	border: 1px solid #d2d6da;
	outline: none;
	font-size: 14px;
	vertical-align: middle;

	&::placeholder {
		color: #9ca6af;
	}
}

button {
	background: #1976d2;
	color: #fff;
	outline: none;
	cursor: pointer;
	border-radius: 4px;
	padding: 8px 12px;
	margin-left: 10px;
	border: none;
	font-size: 14px;
	transition: 0.3s;
	vertical-align: middle;

	&:hover {
		opacity: 0.8;
	}

	&:active {
		opacity: 0.6;
	}

	&:disabled {
		cursor: initial;
		background: #c6c9cc;
		opacity: 0.6;
	}
}

.button-cancel {
	color: #a8aeb3;
	background: none;
	margin-left: 5px;
}

select {
	vertical-align: middle;
	height: 33px;
	width: 152px;
	font-size: 13px;
	margin: 0 !important;
}
</style>
