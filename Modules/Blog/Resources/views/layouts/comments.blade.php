<div class="antialiased mx-auto w-4/5 pt-8">
    <h3 class="mb-4 text-lg font-semibold text-gray-900">Comments</h3>

    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="flex w-1/2">
                <div class="flex-shrink-0 mr-3">
                    <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10"
                         src="{{ asset('images/avatar.png') }}"
                         alt="">
                </div>
                <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <strong>{{ $comment->name }}</strong> <span
                        class="text-xs text-gray-400">{{ date('d-m-Y', strtotime($comment->updated_at)) }}</span>
                    <p class="text-sm">
                        {{ $comment->comment }}

                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
