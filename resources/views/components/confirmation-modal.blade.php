<div
    x-data="{
        show: false,
        title: '',
        message: '',
        confirmCallback: null,
        open(title, message, callback) {
            this.title = title;
            this.message = message;
            this.confirmCallback = callback;
            this.show = true;
        },
        confirm() {
            if (this.confirmCallback) {
                this.confirmCallback();
            }
            this.show = false;
        }
    }"
    x-on:open-confirmation.window="open($event.detail.title, $event.detail.message, $event.detail.callback)"
    x-show="show"
    class="fixed inset-0 z-[100] overflow-y-auto"
    x-cloak
>
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity" 
            aria-hidden="true"
            x-on:click="show = false"
        >
            <div class="absolute inset-0 bg-[#101010]/95 backdrop-blur-sm"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-[32px] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-white/10"
        >
            <div class="bg-[#101010] px-8 pt-8 pb-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#d5aa32]/10 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-[#d5aa32]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-2xl leading-6 font-heading font-bold text-white uppercase tracking-wider" x-text="title"></h3>
                        <div class="mt-4">
                            <p class="text-lg text-gray-400" x-text="message"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#101010] px-8 py-6 flex flex-col sm:flex-row-reverse gap-3 border-t border-white/5">
                <button 
                    type="button" 
                    class="w-full inline-flex justify-center rounded-full border border-transparent shadow-sm px-6 py-3 bg-[#d5aa32] text-base font-bold text-black hover:bg-[#f2df9c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d5aa32] sm:w-auto sm:text-sm transition-colors duration-200"
                    x-on:click="confirm"
                >
                    Confirmar Ação
                </button>
                <button 
                    type="button" 
                    class="w-full inline-flex justify-center rounded-full border border-white/10 shadow-sm px-6 py-3 bg-transparent text-base font-bold text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white sm:w-auto sm:text-sm transition-colors duration-200"
                    x-on:click="show = false"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
