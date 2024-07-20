<?php
require_once 'src/controllers/ChildController.php';

$childController = new ChildController();
$children = $childController->viewChild();
$childrencount = $childController->countchild();

          
           ?>
<section id="child-profile" class="pt-5 pb-10">
    <div class="heading flex justify-between px-10 items-center w-11/12 mx-auto mb-4 max-md:flex-col">
        <h3 class="text-2xl font-semibold mb-4 text-start font">Child Profile Management</h3>
        
        <?php
         if ($childrencount >1) { ?>
            <button onclick="openModal('childModal')" disabled class="bg-pink-500 text-white font-extrabold black_border px-6 py-2 rounded">Add Child</button>
        <?php } else { ?>
        <button onclick="openModal('childModal')" class="bg-pink-500 text-white font-extrabold black_border px-6 py-2 rounded">Add Child</button>
        <?php }  ?>
    </div>
    <div class="children flex gap-8 w-11/12 mx-auto max-md:flex-col">
        <?php if (empty($children)) { ?>
            <p class="text-gray-600 text-center mt-4 w-full">No children yet.</p>
        <?php } else { ?>
            <?php foreach ($children as $child) { ?>
          <div  class="bg-white p-8 rounded-lg w-11/12 mx-auto black_border mb-8">
                    <div  class="flex items-center justify-between mb-6 max-sm:flex-col">
                        <div class="flex items-center max-sm:flex-col" onclick="openModal('securityModal<?php echo htmlspecialchars($child['id']); ?>')">
                            <img src="<?php echo htmlspecialchars($child['avatar']); ?>" alt="Avatar" class="w-16 h-16 rounded-full mr-4">
                            <div class="text-left">
                                <h4 class="text-2xl font-semibold text-center"><?php  echo htmlspecialchars($child['name']); ?></h4>
                                <p class="text-sky-600">Age: <?php echo htmlspecialchars($child['age']); ?></p>
                                <p class="text-sky-600">Date of Birth: <?php echo htmlspecialchars($child['dob']); ?></p>
                                <p class="text-sky-600">Level: <?php echo htmlspecialchars($child['level']); ?></p>
                                <p class="text-sky-600">Gender: <?php echo htmlspecialchars($child['gender']); ?></p>
                            </div>
                        </div>
                        <button onclick="openModal('editChildModal<?php echo htmlspecialchars($child['id']); ?>')" class="pointer max-sm:m-10 bg-pink-500 black_border text-white px-4 py-2 rounded font-semibold">Edit Profile</button>
                    </div>
            </div >
            <!-- Edit Child Modal Content -->

                <?php $id = $child['id'];
                
                 require 'src/views/user/components/securityquestion.php';
                 require 'src/views/user/components/setsecurityquestion.php';
                  require 'src/views/user/components/editchild.php'; ?>
            <?php } ?>
        <?php } ?>
    </div>
</section>
