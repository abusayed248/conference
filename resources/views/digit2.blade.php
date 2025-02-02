<div class="col-md-4">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction2 = App\Models\CallAction::where('digit', 2)->first();
            $selectedFunction2 = $callAction2 ? $callAction2->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars2" id="cars2" class="play form-select">
                <option value="none" {{ $selectedFunction2 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction2 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction2 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction2 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section2" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-2-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit2()">Replace</a>
                <input id="option-2-replace-file-input" type="file" name="option_1_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit2()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section2" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>

                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction2->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-2"
                        onblur="saveNumber2()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer" type="number" readonly class="w-100" value="60" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section2" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>

    </div>
</div>


{{-- modal --}}
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">

                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 2</h3>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="col-md-1">
                                            <label id="file-name" for="file-input"> File</label>
                                        </div>

                                    </div>

                                    <a id="option-2-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2SubMenu()">Replace File</a>
                                    <input
                                        id="option-2-sub-menu-replace-file-input"
                                        type="file"
                                        name="option_6_replace"
                                        style="display:none"
                                        class="replace-img"
                                        accept="audio/mp3,audio/*;capture=microphone"
                                        onchange="uploadFileDigit2SubMenu()" />
                                </div>

                            </div>

                            <div class="col-md-8 py-5 bg-green-600">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>
                                            </div>
                                            <a id="option-2-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub1()">Replace File</a>
                                            <input
                                                id="option-2-sub-1-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_1"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">

                                                <label for="">Function</label>


                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>


                                            <a id="option-2-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub2()">Replace File</a>
                                            <input
                                                id="option-2-sub-2-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_1"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub2()" />
                                        </div>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>
                                            </div>
                                            <a id="option-2-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub3()">Replace File</a>
                                            <input
                                                id="option-2-sub-3-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_1"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub3()" />
                                        </div>

                                    </div>

                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub4()">Replace File</a>
                                            <input
                                                id="option-2-sub-4-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_1"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub4()" />
                                        </div>

                                    </div>
                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub5()">Replace File</a>
                                            <input
                                                id="option-2-sub-5-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_1"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub5()" />
                                        </div>

                                    </div>


                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub6()">Replace File</a>
                                            <input
                                                id="option-2-sub-6-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_6"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub6()" />
                                        </div>

                                    </div>


                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub7()">Replace File</a>
                                            <input
                                                id="option-2-sub-7-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_7"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub7()" />
                                        </div>

                                    </div>


                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub8()">Replace File</a>
                                            <input
                                                id="option-2-sub-8-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_8"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub8()" />
                                        </div>

                                    </div>


                                    <div class="col-md-4 mt-5 ">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                                <label for="">Function</label>
                                                <select name="cars" id="cars" form="" class="play">
                                                    <option value="volvo">Play MP3</option>
                                                    <option value="saab">Saab</option>
                                                    <option value="opel">Opel</option>
                                                    <option value="audi">Audi</option>
                                                </select>

                                            </div>
                                            <a id="option-2-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit2Sub9()">Replace File</a>
                                            <input
                                                id="option-2-sub-9-replace-file-input"
                                                type="file"
                                                name="option_6_replace_sub_9"
                                                style="display:none"
                                                class="replace-img"
                                                accept="audio/mp3,audio/*;capture=microphone"
                                                onchange="uploadFileDigit2Sub9()" />
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectField2 = document.getElementById("cars2");
        const mp3Section2 = document.getElementById("mp3-section2");
        const transferSection2 = document.getElementById("transfer-section2");
        const submenuSection2 = document.getElementById("submenu-section2");


        const selectedFunction2 = "<?php echo $selectedFunction2; ?>";

        if (selectedFunction2 == 'audio') {
            mp3Section2.style.display = "block";
        }
        if (selectedFunction2 == 'transfer') {
            transferSection2.style.display = "block";
        }

        if (selectedFunction2 == 'sub_menu') {
            submenuSection2.style.display = "block";
        }


        function toggleSections2() {
            const selectedValue2 = selectField2.value;

            saveCurrentOption2(selectedValue2);
            mp3Section2.style.display = selectedValue2 === "audio" ? "block" : "none";
            transferSection2.style.display = selectedValue2 === "transfer" ? "block" : "none";
            submenuSection2.style.display = selectedValue2 === "sub_menu" ? "block" : "none";
        }

        selectField2.addEventListener("change", toggleSections2);
    });


    function saveCurrentOption2(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 2
                }) // Update based on digit 1
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    //  alert("File uploaded successfully.");
                } else {
                    console.error("Update failed");
                    //  alert("Failed to upload the file.");
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function triggerFileInputForDigit2() {
        // Trigger file input click
        document.getElementById("option-2-replace-file-input").click();
    }

    function uploadFileDigit2() {
        const fileInput = document.getElementById("option-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data

            fetch("{{ route('mp3-call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }


    function triggerFileInputForDigit2SubMenu() {
        // Trigger file input click
        document.getElementById("option-2-sub-menu-replace-file-input").click();
    }


    function triggerFileInputForDigit2Sub1() {
        // Trigger file input click
        document.getElementById("option-2-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub2() {
        // Trigger file input click
        document.getElementById("option-2-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub9() {
        // Trigger file input click
        document.getElementById("option-2-sub-9-replace-file-input").click();
    }

    function uploadFileDigit2Sub1() {
        const fileInput = document.getElementById("option-2-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 1); // Add any other required data
            formData.append("sub_type", "audio");

            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub2() {
        const fileInput = document.getElementById("option-2-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 2); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub3() {
        const fileInput = document.getElementById("option-2-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 3); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub4() {
        const fileInput = document.getElementById("option-2-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 4); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub9() {
        const fileInput = document.getElementById("option-2-sub-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 9); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function triggerFileInputForDigit2Sub3() {
        // Trigger file input click
        document.getElementById("option-2-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub4() {
        // Trigger file input click
        document.getElementById("option-2-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub5() {
        // Trigger file input click
        document.getElementById("option-2-sub-5-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub6() {
        // Trigger file input click
        document.getElementById("option-2-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub7() {
        // Trigger file input click
        document.getElementById("option-2-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit2Sub8() {
        // Trigger file input click
        document.getElementById("option-2-sub-8-replace-file-input").click();
    }

    function uploadFileDigit2Sub5() {
        const fileInput = document.getElementById("option-2-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 5); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub6() {
        const fileInput = document.getElementById("option-2-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 6); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub7() {
        const fileInput = document.getElementById("option-2-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 7); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2Sub8() {
        const fileInput = document.getElementById("option-2-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub", 8); // Add any other required data
            formData.append("sub_type", "audio");
            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function uploadFileDigit2SubMenu() {
        const fileInput = document.getElementById("option-2-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "sub_menu"); // Add any other required data
            formData.append("digit", 2); // Add any other required data
            formData.append("sub_type", 'greetings'); // Add any other required data
            //    formData.append("sub", 1); // Add any other required data

            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken, // Include CSRF token
                    },
                    body: formData, // Send the file and other data
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("File uploaded successfully:", data);
                        alert("File uploaded successfully.");
                    } else {
                        console.error("Error uploading file:", data);
                        alert("Failed to upload the file.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        } else {
            alert("No file selected.");
        }
    }

    function saveNumber2() {
        const numberInput = document.getElementById('number-input-2').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (numberInput.trim() !== "") {
            fetch("{{ route('call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        type: "transfer", // Replace with the actual type value
                        number: numberInput,
                        afer: 60, // Adjust as needed
                        digit: 2, // Adjust as needed
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("Data saved successfully:", data);
                        alert("Number saved successfully.");
                    } else {
                        console.error("Error saving data:", data);
                        alert("Failed to save the number.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        }
    }

</script>
