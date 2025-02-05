<div class="col-md-4 mt-3">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction9 = App\Models\CallAction::where('digit', 9)->first();
            $selectedFunction9 = $callAction9 ? $callAction9->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars9" id="cars9" class="play form-select">
                <option value="none" {{ $selectedFunction9 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction9 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction9 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction9 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section9" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-9-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit9()">Replace</a>
                <input id="option-9-replace-file-input" type="file" name="option_9_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section9" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>
                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction9->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-9"
                        onblur="saveNumber9()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer_time" type="number" value="{{ @$callAction9->afer_time}}"
                    class="w-100" placeholder="60" id="afer-number-input-9" onblur="saveNumber9()" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section9" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop9" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Digit 5 -->
<div class="modal fade" id="staticBackdrop9" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">
                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 9</h3>
                                    <a id="option-9-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9SubMenu()">Replace</a>
                                    <input id="option-9-sub-menu-replace-file-input" type="file" name="option_9_replace_sub" style="display:none"
                                        class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9SubMenu()" />
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
                                            <a id="option-9-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub1()">Replace</a>
                                            <input id="option-9-sub-1-replace-file-input" type="file" name="option_9_replace_sub_1" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub2()">Replace</a>
                                            <input id="option-9-sub-2-replace-file-input" type="file" name="option_9_replace_sub_2" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub2()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub3()">Replace</a>
                                            <input id="option-9-sub-3-replace-file-input" type="file" name="option_9_replace_sub_3" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub3()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub4()">Replace</a>
                                            <input id="option-9-sub-4-replace-file-input" type="file" name="option_9_replace_sub_4" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub4()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub5()">Replace</a>
                                            <input id="option-9-sub-5-replace-file-input" type="file" name="option_9_replace_sub_5" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub5()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub6()">Replace</a>
                                            <input id="option-9-sub-6-replace-file-input" type="file" name="option_9_replace_sub_6" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub6()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub7()">Replace</a>
                                            <input id="option-9-sub-7-replace-file-input" type="file" name="option_9_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub7()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub8()">Replace</a>
                                            <input id="option-9-sub-8-replace-file-input" type="file" name="option_9_replace_sub_8" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub8()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-9-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit9Sub9()">Replace</a>
                                            <input id="option-9-sub-9-replace-file-input" type="file" name="option_9_replace_sub_9" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit9Sub9()" />
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
        const selectField9 = document.getElementById("cars9");
        const mp3section9 = document.getElementById("mp3-section9");
        const transfersection9 = document.getElementById("transfer-section9");
        const submenusection9 = document.getElementById("submenu-section9");

        const selectedFunction9 = "<?php echo $selectedFunction9; ?>";

        if (selectedFunction9 == 'audio') {
            mp3section9.style.display = "block";
        }
        if (selectedFunction9 == 'transfer') {
            transfersection9.style.display = "block";
        }

        if (selectedFunction9 == 'sub_menu') {
            submenusection9.style.display = "block";
        }

        function toggleSections9() {
            const selectedValue9 = selectField9.value;

            saveCurrentOption9(selectedValue9);
            mp3section9.style.display = selectedValue9 === "audio" ? "block" : "none";
            transfersection9.style.display = selectedValue9 === "transfer" ? "block" : "none";
            submenusection9.style.display = selectedValue9 === "sub_menu" ? "block" : "none";
        }

        selectField9.addEventListener("change", toggleSections9);
    });

    function saveCurrentOption9(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 9
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

    function triggerFileInputForDigit9() {
        document.getElementById("option-9-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub3() {
        // Trigger file input click
        document.getElementById("option-9-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub4() {
        // Trigger file input click
        document.getElementById("option-9-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub5() {
        // Trigger file input click
        document.getElementById("option-9-sub-5-replace-file-input").click();
    }
    function triggerFileInputForDigit9Sub6() {
        // Trigger file input click
        document.getElementById("option-9-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub7() {
        // Trigger file input click
        document.getElementById("option-9-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub8() {
        // Trigger file input click
        document.getElementById("option-9-sub-8-replace-file-input").click();
    }

    function uploadFileDigit9() {
        const fileInput = document.getElementById("option-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);

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

    function triggerFileInputForDigit9SubMenu() {
        document.getElementById("option-9-sub-menu-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub1() {
        document.getElementById("option-9-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub2() {
        document.getElementById("option-9-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit9Sub9() {
        document.getElementById("option-9-sub-9-replace-file-input").click();
    }

    function uploadFileDigit9Sub1() {
        const fileInput = document.getElementById("option-9-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
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

    function uploadFileDigit9Sub2() {
        const fileInput = document.getElementById("option-9-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 2);
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

    function uploadFileDigit9Sub3() {
        const fileInput = document.getElementById("option-9-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 3);
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

    function uploadFileDigit9Sub4() {
        const fileInput = document.getElementById("option-9-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 4);
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

    function uploadFileDigit9Sub5() {
        const fileInput = document.getElementById("option-9-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 5);
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

    function uploadFileDigit9Sub6() {
        const fileInput = document.getElementById("option-9-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 6);
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

    function uploadFileDigit9Sub7() {
        const fileInput = document.getElementById("option-9-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 7);
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

    function uploadFileDigit9Sub8() {
        const fileInput = document.getElementById("option-9-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 8);
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

    function uploadFileDigit9Sub9() {
        const fileInput = document.getElementById("option-9-sub-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 9);
            formData.append("sub", 9);
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

    function uploadFileDigit9SubMenu() {
        const fileInput = document.getElementById("option-9-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "sub_menu");
            formData.append("digit", 9);
            formData.append("sub_type", "greetings");

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

    function saveNumber9() {
        const numberInput = document.getElementById('number-input-9').value;
        const aferNumberInput9 = document.getElementById('afer-number-input-9').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (numberInput.trim() !== "") {
            fetch("{{ route('call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        type: "transfer",
                        number: numberInput,
                        afer_time: aferNumberInput9,
                        digit: 9,
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
