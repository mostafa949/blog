
<label for="toggle-example" class="flex relative items-center cursor-pointer mt-6">
    <input type="checkbox" id="toggle-example" class="sr-only" name="publish" value="1" @if(isset($postPublish)) checked @endif>
    <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publish</span>
</label>
