<div class="bg-white p-6 rounded-lg black_border mb-4 ">
    <h2 class="text-xl font-semibold mb-4 font"><?php echo htmlspecialchars($lesson['title']); ?></h2>
    <p class="text-gray-600 mb-4 font-mono text-lg"><?php echo htmlspecialchars($lesson['description']); ?></p>
    <?php if (!empty($lesson['thumbnail_url'])): ?>
        <img src="<?php echo htmlspecialchars($lesson['thumbnail_url']); ?>" alt="Thumbnail" class="w-full h-auto rounded mb-4">
    <?php endif; ?>
    <p class="text-gray-700 mb-2 font-mono"><strong>Subject:</strong> <?php echo htmlspecialchars($lesson['subject_name']); ?></p>
    <p class="text-gray-700 mb-4 font-mono"><strong>Level:</strong> <?php echo htmlspecialchars($lesson['level_name']); ?></p>
    <div class="mt-4 flex align-baseline justify-between">
        <button type="button" class="text-indigo-600 hover:text-indigo-900 mr-4" onclick="openVideoModal('<?php echo htmlspecialchars($lesson['video_url']); ?>')">View Video</button>
        <div>
            <button type="submit" onclick="openModal('editLessonModal-<?php echo $lesson['id']; ?>')" class="bg-indigo-600 hover:bg-indigo-900 mr-4 font font-bold text-white rounded-md black_border py-2 px-2">Edit</button>
            <a href="/admin/lessons/delete/<?php echo $lesson['id']; ?>" class="text-black hover:text-grey-700 bg-red-300 font-bold rounded-md black_border py-2 px-2">Delete</a>
        </div>
    </div>
</div>



    <div id="videoModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-md max-w-lg w-full relative black_border">
        <button type="button" onclick="closeVideoModal()" class="absolute top-2 right-2 text-gray-700 hover:text-gray-900">&times;</button>
        <h2 class="text-2xl font-extrabold text-purple-500 mb-4">Lesson Video</h2>
        <div id="videoContainer" class="w-full h-64">
            <iframe id="videoFrame" class="w-full h-full rounded" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>