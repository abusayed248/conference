<div class="col-md-4 mt-3">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction8 = App\Models\CallAction::where('digit', 8)->first();
            $selectedFunction8 = $callAction8 ? $callAction8->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars8" id="cars8" class="play form-select">
                <option value="none" {{ $selectedFunction8 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction8 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction8 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction8 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section8" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-8-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit8()">Replace</a>
                <input id="option-8-replace-file-input" type="file" name="option_8_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section8" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>
                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction8->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-8"
                        onblur="saveNumber8()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer_time" type="number" value="{{ @$callAction8->afer_time}}"
                    class="w-100"
                    placeholder="60"
                    id="afer-number-input-8"
                    onblur="saveNumber8()" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section8" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop8" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Digit 5 -->
<div class="modal fade" id="staticBackdrop8" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">
                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 8</h3>
                                    <a id="option-8-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8SubMenu()">Replace</a>
                                    <input id="option-8-sub-menu-replace-file-input" type="file" name="option_8_replace_sub" style="display:none"
                                        class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8SubMenu()" />
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
                                            <a id="option-8-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub1()">Replace</a>
                                            <input id="option-8-sub-1-replace-file-input" type="file" name="option_8_replace_sub_1" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub2()">Replace</a>
                                            <input id="option-8-sub-2-replace-file-input" type="file" name="option_8_replace_sub_2" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub2()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub3()">Replace</a>
                                            <input id="option-8-sub-3-replace-file-input" type="file" name="option_8_replace_sub_3" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub3()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub4()">Replace</a>
                                            <input id="option-8-sub-4-replace-file-input" type="file" name="option_8_replace_sub_4" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub4()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub5()">Replace</a>
                                            <input id="option-8-sub-5-replace-file-input" type="file" name="option_8_replace_sub_5" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub5()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub6()">Replace</a>
                                            <input id="option-8-sub-6-replace-file-input" type="file" name="option_8_replace_sub_6" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub6()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub7()">Replace</a>
                                            <input id="option-8-sub-7-replace-file-input" type="file" name="option_8_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub7()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub8()">Replace</a>
                                            <input id="option-8-sub-8-replace-file-input" type="file" name="option_8_replace_sub_8" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub8()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-8-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit8Sub9()">Replace</a>
                                            <input id="option-8-sub-9-replace-file-input" type="file" name="option_8_replace_sub_9" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit8Sub9()" />
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
        const selectField8 = document.getElementById("cars8");
        const mp3section8 = document.getElementById("mp3-section8");
        const transfersection8 = document.getElementById("transfer-section8");
        const submenusection8 = document.getElementById("submenu-section8");

        const selectedFunction8 = "<?php echo $selectedFunction8; ?>";

        if (selectedFunction8 == 'audio') {
            mp3section8.style.display = "block";
        }
        if (selectedFunction8 == 'transfer') {
            transfersection8.style.display = "block";
        }

        if (selectedFunction8 == 'sub_menu') {
            submenusection8.style.display = "block";
        }

        function toggleSections8() {
            const selectedValue7 = selectField8.value;

            saveCurrentOption8(selectedValue7);
            mp3section8.style.display = selectedValue7 === "audio" ? "block" : "none";
            transfersection8.style.display = selectedValue7 === "transfer" ? "block" : "none";
            submenusection8.style.display = selectedValue7 === "sub_menu" ? "block" : "none";
        }

        selectField8.addEventListener("change", toggleSections8);
    });

    function saveCurrentOption8(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 8
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

    function triggerFileInputForDigit8() {
        document.getElementById("option-8-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub3() {
        // Trigger file input click
        document.getElementById("option-8-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub4() {
        // Trigger file input click
        document.getElementById("option-8-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub5() {
        // Trigger file input click
        document.getElementById("option-8-sub-5-replace-file-input").click();
    }
    function triggerFileInputForDigit8Sub6() {
        // Trigger file input click
        document.getElementById("option-8-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub7() {
        // Trigger file input click
        document.getElementById("option-8-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub8() {
        // Trigger file input click
        document.getElementById("option-8-sub-8-replace-file-input").click();
    }



    function uploadFileDigit8() {
        const fileInput = document.getElementById("option-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);

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

    function triggerFileInputForDigit8SubMenu() {
        document.getElementById("option-8-sub-menu-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub1() {
        document.getElementById("option-8-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub2() {
        document.getElementById("option-8-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit8Sub9() {
        document.getElementById("option-8-sub-9-replace-file-input").click();
    }

    function uploadFileDigit8Sub1() {
        const fileInput = document.getElementById("option-8-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub2() {
        const fileInput = document.getElementById("option-8-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub3() {
        const fileInput = document.getElementById("option-8-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub4() {
        const fileInput = document.getElementById("option-8-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub5() {
        const fileInput = document.getElementById("option-8-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub6() {
        const fileInput = document.getElementById("option-8-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub7() {
        const fileInput = document.getElementById("option-8-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub8() {
        const fileInput = document.getElementById("option-8-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8Sub9() {
        const fileInput = document.getElementById("option-8-sub-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 8);
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

    function uploadFileDigit8SubMenu() {
        const fileInput = document.getElementById("option-8-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "sub_menu");
            formData.append("digit", 8);
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

    function saveNumber8() {
        const numberInput = document.getElementById('number-input-8').value;
        const aferNumberInput8 = document.getElementById('afer-number-input-8').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (numberInput.trim() !== "" || aferNumberInput8.trim() !== "") {
            fetch("{{ route('call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        type: "transfer",
                        number: numberInput,
                        afer_time: aferNumberInput8,
                        digit: 8,
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
