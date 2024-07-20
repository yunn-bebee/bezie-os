 <!-- Edit Modal -->
 <div id="editLessonModal-<?php echo $lesson['id']; ?>" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white p-8 rounded-md max-w-lg w-full relative black_border">
                                <h2 class="text-2xl font-extrabold font text-purple-500 mb-4">Edit Lesson</h2>
                                <form action="/admin/updatelesson" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
                                    <div class="mb-4">
                                        <label for="title-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Lesson Title</label>
                                        <input type="text" id="title-<?php echo $lesson['id']; ?>" name="title" class="border rounded p-2 w-full" value="<?php echo htmlspecialchars($lesson['title']); ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Lesson Description</label>
                                        <textarea id="description-<?php echo $lesson['id']; ?>" name="description" rows="4" class="border rounded p-2 w-full" required><?php echo htmlspecialchars($lesson['description']); ?></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="subject_id-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Subject</label>
                                        <select id="subject_id-<?php echo $lesson['id']; ?>" name="subject_id" class="border rounded p-2 w-full">
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?php echo $subject['id']; ?>" <?php echo $lesson['subject_id'] == $subject['id'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($subject['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="level_id-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Level</label>
                                        <select id="level_id-<?php echo $lesson['id']; ?>" name="level_id" class="border rounded p-2 w-full">
                                            <?php foreach ($levels as $level): ?>
                                                <option value="<?php echo $level['id']; ?>" <?php echo $lesson['level_id'] == $level['id'] ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($level['level_name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="video_url-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Video URL (Optional)</label>
                                        <input type="text" id="video_url-<?php echo $lesson['id']; ?>" name="video_url" class="border rounded p-2 w-full" value="<?php echo htmlspecialchars($lesson['video_url']); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="thumbnail_url-<?php echo $lesson['id']; ?>" class="block text-gray-700 font">Thumbnail URL (Optional)</label>
                                        <input type="text" id="thumbnail_url-<?php echo $lesson['id']; ?>" name="thumbnail_url" class="border rounded p-2 w-full" value="<?php echo htmlspecialchars($lesson['thumbnail_url']); ?>">
                                    </div>
                                    <div class="flex justify-evenly w-full">
                                        <button type="button" onclick="closeModal('editLessonModal-<?php echo $lesson['id']; ?>')" class="font bg-gray-300 text-black px-4 py-2 rounded mr-2 black_border">Cancel</button>
                                        <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded black_border font">Update Lesson</button>
                                    </div>
                                </form>
                            </div>
                        </div>