<div id="editAchievementModal-<?php echo $achievement['id']; ?>" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-md max-w-lg w-full relative black_border">
        <h2 class="text-2xl font-extrabold font text_shadow text-purple-500 mb-4">Edit Achievement</h2>
        <form action="/admin/achievements/edit" method="POST">
            <input type="hidden" name="id" value="<?php echo $achievement['id']; ?>">
            <div class="mb-4">
                <label for="title-<?php echo $achievement['id']; ?>" class="block text-gray-700 font">Title</label>
                <input type="text" id="title-<?php echo $achievement['id']; ?>" name="title" class="border rounded p-2 w-full" value="<?php echo htmlspecialchars($achievement['title']); ?>" required>
            </div>
            <div class="mb-4">
                <label for="description-<?php echo $achievement['id']; ?>" class="block text-gray-700 font">Description</label>
                <textarea id="description-<?php echo $achievement['id']; ?>" name="description" rows="4" class="border rounded p-2 w-full" required><?php echo htmlspecialchars($achievement['description']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="badge_picture_url-<?php echo $achievement['id']; ?>" class="block text-gray-700 font">Badge Picture URL</label>
                <input type="text" id="badge_picture_url-<?php echo $achievement['id']; ?>" name="badge_picture_url" class="border rounded p-2 w-full" value="<?php echo htmlspecialchars($achievement['badge_picture_url']); ?>">
            </div>
            <div class="flex justify-evenly w-full">
                <button type="button" onclick="closeModal('editAchievementModal-<?php echo $achievement['id']; ?>')" class="font bg-gray-300 text-black px-4 py-2 rounded mr-2 black_border">Cancel</button>
                <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded black_border font">Update Achievement</button>
            </div>
        </form>
    </div>
</div>
