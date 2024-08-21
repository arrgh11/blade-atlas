
<fieldset>
    <legend class="text-sm font-semibold leading-6 text-gray-900">Notifications</legend>
    <p class="mt-1 text-sm leading-6 text-gray-600">How do you prefer to receive notifications?</p>
    <div class="mt-6 space-y-6 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
        <div class="flex items-center">
            <input id="email" name="notification-method" type="radio" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="email" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Email</label>
        </div>
        <div class="flex items-center">
            <input id="sms" name="notification-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="sms" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Phone (SMS)</label>
        </div>
        <div class="flex items-center">
            <input id="push" name="notification-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="push" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Push notification</label>
        </div>
    </div>
</fieldset>
