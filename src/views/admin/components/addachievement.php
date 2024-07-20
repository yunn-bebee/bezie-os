<div id="addAchievementModal" class="fixed font-mono inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-md w-1/3 max-md:w-1/2 max-sm:w-full black_border">
            <h2 class="text-2xl font-bold mb-4 font">Add Achievement</h2>
            <form action="/admin/achievements/add" method="POST">
                <div class="mb-4">
                    <label for="title" class="block text-sm font font-semibold mb-2">Title</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-2 border-black border  rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block font text-sm font-semibold mb-2">Description</label>
                    <textarea name="description" id="description" class="w-full border-black border  px-4 py-2 rounded"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="badge_picture_url" class="block font text-sm font-semibold mb-2">Badge Picture URL</label>
                    <input type="text" name="badge_picture_url" id="badge_picture_url"
                        class="w-full border-black border  px-4 py-2 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('addAchievementModal')"
                        class="bg-gray-300 px-4 py-2 rounded mr-2 font black_border">Cancel</button>
                    <button type="submit" name="add" class="bg-pink-500 font black_border text-white px-4 py-2 rounded">Add</button>
                </div>
            </form>
        </div>
    </div>