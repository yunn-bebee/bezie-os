<div id="guardianReviewModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="modal-bg fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity black_border"></div>
        <div class="bg-orange-200 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6 z-20">
            <h2 class="text-2xl font-bold mb-4 font">Leave a Review for Guardian</h2>
            <form action="/submit_guardian_review" method="POST">
                <input type="hidden" id="guardianId" value="<?php echo $_SESSION['guardian_id']?>" name="guardianId">
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 font">Rating</label>
                    <select id="rating" name="rating" class="border rounded p-2 w-full">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="review" class="block text-gray-700 font">Review</label>
                    <textarea id="review" name="review" class="border rounded p-2 w-full" rows="5"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('guardianReviewModal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded black_border">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
