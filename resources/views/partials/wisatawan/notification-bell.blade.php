<div class="relative" x-data="notificationBell()">
    <!-- Notification Bell Button -->
    <button
        @click="toggleNotifications()"
        class="p-2 text-gray-600 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-colors relative"
        :class="{ 'text-blue-600 bg-blue-50': isOpen }"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5" />
        </svg>

        <!-- Notification Badge -->
        <span
            x-show="unreadCount > 0"
            x-text="unreadCount > 99 ? '99+' : unreadCount"
            class="absolute -top-1 -right-1 min-w-[18px] h-[18px] bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-medium"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
        ></span>
    </button>

    <!-- Notification Dropdown -->
    <div
        x-show="isOpen"
        @click.away="closeNotifications()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-1"
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 max-h-96 overflow-hidden z-50"
    >
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
            <div class="flex items-center space-x-2">
                <span x-show="unreadCount > 0" class="text-xs text-gray-500" x-text="`${unreadCount} baru`"></span>
                <button
                    @click="markAllAsRead()"
                    x-show="unreadCount > 0"
                    class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                >
                    Tandai sudah dibaca
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div x-show="loading" class="px-4 py-6 flex justify-center">
            <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <!-- Empty State -->
        <div x-show="!loading && notifications.length === 0" class="px-4 py-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5" />
            </svg>
            <p class="mt-2 text-sm text-gray-500">Tidak ada notifikasi</p>
        </div>

        <!-- Notifications List -->
        <div x-show="!loading && notifications.length > 0" class="max-h-80 overflow-y-auto">
            <template x-for="notification in (showAll ? notifications : notifications.slice(0, 5))" :key="notification.id">
                <div
                    class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b border-gray-50 last:border-b-0 transition-colors"
                    :class="{ 'bg-blue-50': !notification.read }"
                    @click="handleNotificationClick(notification)"
                >
                    <div class="flex items-start space-x-3">
                        <!-- Status Indicator -->
                        <div class="flex-shrink-0 mt-1">
                            <div
                                class="w-2 h-2 rounded-full"
                                :class="{
                                    'bg-blue-500': !notification.read,
                                    'bg-gray-300': notification.read
                                }"
                            ></div>
                        </div>

                        <!-- Icon -->
                        <div class="flex-shrink-0 mt-0.5">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center"
                                :class="`bg-${notification.color}-100`"
                            >
                                <svg class="w-4 h-4" :class="`text-${notification.color}-600`" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="notification.icon" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <p
                                class="text-sm font-medium"
                                :class="{
                                    'text-gray-900': !notification.read,
                                    'text-gray-600': notification.read
                                }"
                                x-text="notification.title"
                            ></p>
                            <p class="text-xs text-gray-500 mt-1" x-text="notification.description"></p>
                            <p class="text-xs text-gray-400 mt-1" x-text="timeAgo(notification.date)"></p>
                        </div>

                        <!-- Arrow -->
                        {{-- <div class="flex-shrink-0 mt-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div> --}}
                    </div>
                </div>
            </template>
        </div>

        <!-- Show More/Less Button -->
        <div x-show="!loading && notifications.length > 5" class="px-4 py-3 border-t border-gray-100 bg-gray-50">
            <button
                @click="showAll = !showAll"
                class="text-sm text-blue-600 hover:text-blue-800 font-medium w-full text-center"
                x-text="showAll ? 'Sembunyikan' : `Lihat semua (${notifications.length})`"
            ></button>
        </div>
    </div>
</div>

<script>
function notificationBell() {
    return {
        isOpen: false,
        loading: false,
        notifications: [],
        unreadCount: 0,
        showAll: false,

        async init() {
            await this.fetchNotifications();
        },

        async fetchNotifications() {
            this.loading = true;
            try {
                const response = await fetch('/wisatawan/notifications', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                });

                if (response.ok) {
                    const data = await response.json();
                    this.notifications = data.activities || [];
                    this.unreadCount = data.unreadCount || 0;
                }
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
            this.loading = false;
        },

        async toggleNotifications() {
            this.isOpen = !this.isOpen;
            if (this.isOpen && this.notifications.length === 0) {
                await this.fetchNotifications();
            }
        },

        closeNotifications() {
            this.isOpen = false;
            this.showAll = false;
        },

        async markAllAsRead() {
            try {
                const response = await fetch('/wisatawan/notifications/mark-read', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'include'
                });

                if (response.ok) {
                    this.notifications = this.notifications.map(n => ({ ...n, read: true }));
                    this.unreadCount = 0;
                }
            } catch (error) {
                console.error('Error marking notifications as read:', error);
            }
        },

        handleNotificationClick(notification) {
            // Mark as read
            if (!notification.read) {
                notification.read = true;
                this.unreadCount = Math.max(0, this.unreadCount - 1);
            }

            // Navigate to URL if available
            // if (notification.url) {
            //     window.location.href = notification.url;
            // }

            this.closeNotifications();
        },

        timeAgo(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);

            const intervals = {
                tahun: 31536000,
                bulan: 2592000,
                minggu: 604800,
                hari: 86400,
                jam: 3600,
                menit: 60
            };

            for (const [unit, secondsInUnit] of Object.entries(intervals)) {
                const interval = Math.floor(seconds / secondsInUnit);
                if (interval >= 1) {
                    return interval === 1 ? `1 ${unit} yang lalu` : `${interval} ${unit} yang lalu`;
                }
            }

            return 'Baru saja';
        }
    }
}
</script>
