<div>
    <!-- Floating Chatbot Button to Open/Close Chat Window -->
    <button wire:click="toggleChat"
        class="btn btn-primary rounded-circle position-fixed d-flex align-items-center justify-content-center shadow-lg"
        style="bottom: 25px; right: 25px; width: 60px; height: 60px; z-index: 9999;">
        <i class="icon-chat text-white" style="font-size: 24px;"></i>
    </button>

    <!-- Chatbot Window -->
    @if ($isOpen)
        <div class="card position-fixed shadow-lg border-0 rounded-lg"
            style="bottom: 95px; right: 25px; width: 350px; max-width: 90vw; height: 480px; z-index: 9999;">

            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <div class="d-flex align-items-center">
                    <i class="icon-chat mr-2"></i>
                    <h6 class="mb-0 text-white font-weight-bold">Customer Assistant</h6>
                </div>
                <!-- Close Button -->
                <button wire:click="toggleChat" type="button" class="close text-white opacity-100" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body (Messages Area) -->
            <div class="card-body overflow-auto p-3 bg-light" style="height: 350px;">
                @foreach ($messages as $msg)
                    <div class="d-flex mb-3 {{ $msg['sender'] === 'user' ? 'justify-content-end' : 'justify-content-start' }}">
                        <div class="p-3 rounded shadow-sm border {{ $msg['sender'] === 'user' ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                            style="max-width: 85%;">
                            <!-- dir="auto" detects Arabic/English direction automatically -->
                            <div class="mb-0 small" dir="auto" style="white-space: pre-line; word-break: break-word; text-align: start;">
                                {!! nl2br(e($msg['text'])) !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Loading Indicator shown while waiting for response -->
                <div wire:loading wire:target="sendMessage" wire:loading.remove.class="d-none" class="d-none">
                    <div class="d-flex justify-content-start mb-3">
                        <div class="p-2 rounded bg-white text-muted border small shadow-sm" dir="auto">
                            <span class="spinner-border spinner-border-sm text-primary me-1" role="status"
                                aria-hidden="true"></span>
                            <em>Typing a response...</em>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer (Input Area) -->
            <div class="card-footer bg-white border-top-0 p-2">
                <form wire:submit.prevent="sendMessage">
                    <div class="input-group">
                        <input type="text" wire:model="userMessage" dir="auto"
                            class="form-control form-control-sm border-right-0"
                            placeholder="Write your question here..." style="font-size: 14px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm px-3" type="submit">
                                <i class="icon-send"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    @endif

    <!-- JavaScript Hook to Auto-Scroll to the Latest Message -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('commit', ({ respond }) => {
                respond(() => {
                    const chatBody = document.querySelector('.card-body.overflow-auto');
                    if (chatBody) {
                        chatBody.scrollTop = chatBody.scrollHeight;
                    }
                });
            });
        });
    </script>
</div>
