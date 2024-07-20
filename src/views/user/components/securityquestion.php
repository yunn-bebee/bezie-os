<!-- Security Question Modal -->
<div id="securityModal<?php echo $id?>" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-orange-200 p-8 rounded-md max-w-md mx-auto black_border">
        <h2 class="text-xl font-semibold mb-4">Security Question</h2>
        <p class="mb-4">Please answer the following security question to enter the <?php echo htmlspecialchars($child['name']); ?>  dashboard:</p>
        <form action="child/verify_security_answer" method="POST" class="space-y-4">
            <input type="hidden" name="child_id" value="<?php echo $id ?>">
            <div class="flex flex-col">
                <label for="security_answer" class="text-sm font-medium text-gray-700">What is your favorite pet's name?</label>
                <input type="text" id="security_answer" name="security_answer" class="border rounded p-2">
            </div>
         <?php   if(empty($child['security_answer'])){ ?>
            <small>Haven't add the answer yet?<a class="text-pink-500 underline" onclick="openModal('setSecurityQuestionModal<?php echo htmlspecialchars($child['id']); ?>')">Add here</a></small>
            <?php } else {?> 
                <small>Forget the answer?<a class="text-pink-500 underline" onclick="openModal('setSecurityQuestionModal<?php echo htmlspecialchars($child['id']); ?>')">Add here</a></small>
            <?php } ?>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-semibold">Submit</button>
                <button type="button" onclick="closeModal('securityModal<?php echo $id?>')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded font-semibold ml-4">Cancel</button>
            </div>
            <br>
        </form>
    </div>
</div>
