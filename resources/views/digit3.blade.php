<div class="col-md-4">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction3 = App\Models\CallAction::where('digit', 3)->first();
            $selectedFunction3 = $callAction3 ? $callAction3->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars3" id="cars3" class="play form-select">
                <option value="none" {{ $selectedFunction3 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction3 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction3 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction3 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section3" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-3-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit3()">Replace</a>
                <input id="option-3-replace-file-input" type="file" name="option_3_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section3" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>
                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction3->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-3"
                        onblur="saveNumber3()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer_time" type="number" id="afer-number-input-3" class="w-100" value="{{ @$callAction3->afer_time}}" placeholder="60" onblur="saveNumber3()" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section3" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">
                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 3</h3>
                                    <a id="option-3-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3SubMenu()">Replace</a>
                                    <input id="option-3-sub-menu-replace-file-input" type="file" name="option_3_replace_sub" style="display:none"
                                        class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3SubMenu()" />
                                </div>
                            </div>

                            <div class="col-md-8 py-5 bg-green-600">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub1()">Replace</a>
                                            <input id="option-3-sub-1-replace-file-input" type="file" name="option_3_replace_sub_1" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub2()">Replace</a>
                                            <input id="option-3-sub-2-replace-file-input" type="file" name="option_3_replace_sub_2" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub2()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub3()">Replace</a>
                                            <input id="option-3-sub-3-replace-file-input" type="file" name="option_3_replace_sub_3" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub3()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub4()">Replace</a>
                                            <input id="option-3-sub-4-replace-file-input" type="file" name="option_3_replace_sub_4" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub4()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub5()">Replace</a>
                                            <input id="option-3-sub-5-replace-file-input" type="file" name="option_3_replace_sub_5" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub5()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub6()">Replace</a>
                                            <input id="option-3-sub-6-replace-file-input" type="file" name="option_3_replace_sub_6" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub6()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub7()">Replace</a>
                                            <input id="option-3-sub-7-replace-file-input" type="file" name="option_3_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub7()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub8()">Replace</a>
                                            <input id="option-3-sub-8-replace-file-input" type="file" name="option_3_replace_sub_8" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub8()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-3-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit3Sub9()">Replace</a>
                                            <input id="option-3-sub-9-replace-file-input" type="file" name="option_3_replace_sub_9" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit3Sub9()" />
                                        </div>
                                    </div>


                                </div>
                            </div> <!-- End of col-md-8 -->
                        </div> <!-- End of row -->
                    </div> <!-- End of container-fluid -->
                </div> <!-- End of mt-5 -->
            </div> <!-- End of modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div> <!-- End of modal-content -->
    </div> <!-- End of modal-dialog -->
</div> <!-- End of modal -->


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectField3 = document.getElementById("cars3");
        const mp3Section3 = document.getElementById("mp3-section3");
        const transferSection3 = document.getElementById("transfer-section3");
        const submenuSection3 = document.getElementById("submenu-section3");

        const selectedFunction3 = "<?php echo $selectedFunction3; ?>";

        if (selectedFunction3 == 'audio') {
            mp3Section3.style.display = "block";
        }
        if (selectedFunction3 == 'transfer') {
            transferSection3.style.display = "block";
        }

        if (selectedFunction3 == 'sub_menu') {
            submenuSection3.style.display = "block";
        }

        function toggleSections3() {
            const selectedValue3 = selectField3.value;

            saveCurrentOption3(selectedValue3);
            mp3Section3.style.display = selectedValue3 === "audio" ? "block" : "none";
            transferSection3.style.display = selectedValue3 === "transfer" ? "block" : "none";
            submenuSection3.style.display = selectedValue3 === "sub_menu" ? "block" : "none";
        }

        selectField3.addEventListener("change", toggleSections3);
    });

    function saveCurrentOption3(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 3
                })
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

    function triggerFileInputForDigit3() {
        document.getElementById("option-3-replace-file-input").click();
    }

    function uploadFileDigit3() {
        const fileInput = document.getElementById("option-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 3);

            fetch("{{ route('mp3-call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: formData,
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

    function triggerFileInputForDigit3SubMenu() {
        document.getElementById("option-3-sub-menu-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub1() {
        document.getElementById("option-3-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub2() {
        document.getElementById("option-3-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub9() {
        document.getElementById("option-3-sub-9-replace-file-input").click();
    }

    function uploadFileDigit3Sub1() {
        const fileInput = document.getElementById("option-3-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 3);
            formData.append("sub", 1);
            formData.append("sub_type", "audio");

            fetch("{{ route('mp3-call-action-sub.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: formData,
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


    function uploadFileDigit3Sub2() {
        const fileInput = document.getElementById("option-3-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub3() {
        const fileInput = document.getElementById("option-3-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub4() {
        const fileInput = document.getElementById("option-3-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub9() {
        const fileInput = document.getElementById("option-3-sub-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function triggerFileInputForDigit3Sub3() {
        // Trigger file input click
        document.getElementById("option-3-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub4() {
        // Trigger file input click
        document.getElementById("option-3-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub5() {
        // Trigger file input click
        document.getElementById("option-3-sub-5-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub6() {
        // Trigger file input click
        document.getElementById("option-3-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub7() {
        // Trigger file input click
        document.getElementById("option-3-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit3Sub8() {
        // Trigger file input click
        document.getElementById("option-3-sub-8-replace-file-input").click();
    }

    function uploadFileDigit3Sub5() {
        const fileInput = document.getElementById("option-3-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub6() {
        const fileInput = document.getElementById("option-3-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub7() {
        const fileInput = document.getElementById("option-3-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3Sub8() {
        const fileInput = document.getElementById("option-3-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "audio"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function uploadFileDigit3SubMenu() {
        const fileInput = document.getElementById("option-3-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile); // Append the selected file
            formData.append("type", "sub_menu"); // Add any other required data
            formData.append("digit", 3); // Add any other required data
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

    function saveNumber3() {
        const numberInput = document.getElementById('number-input-3').value;
        const aferNumberInput3 = document.getElementById('afer-number-input-3').value;
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
                        afer_time: aferNumberInput3, // Adjust as needed
                        digit: 3, // Adjust as needed
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
