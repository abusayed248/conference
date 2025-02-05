<div class="col-md-4 mt-3">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction7 = App\Models\CallAction::where('digit', 7)->first();
            $selectedFunction7 = $callAction7 ? $callAction7->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars7" id="cars7" class="play form-select">
                <option value="none" {{ $selectedFunction7 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction7 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction7 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction7 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section7" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-7-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit7()">Replace</a>
                <input id="option-7-replace-file-input" type="file" name="option_7_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section7" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>
                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction7->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-7"
                        onblur="saveNumber7()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer_time" type="number" value="{{ @$callAction7->afer_time}}" class="w-100" id="afer-number-input-7"
                    onblur="saveNumber7()" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section7" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop7" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Digit 5 -->
<div class="modal fade" id="staticBackdrop7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">
                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 7</h3>
                                    <a id="option-7-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7SubMenu()">Replace</a>
                                    <input id="option-7-sub-menu-replace-file-input" type="file" name="option_7_replace_sub" style="display:none"
                                        class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7SubMenu()" />
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
                                            <a id="option-7-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub1()">Replace</a>
                                            <input id="option-7-sub-1-replace-file-input" type="file" name="option_7_replace_sub_1" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub2()">Replace</a>
                                            <input id="option-7-sub-2-replace-file-input" type="file" name="option_7_replace_sub_2" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub2()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub3()">Replace</a>
                                            <input id="option-7-sub-3-replace-file-input" type="file" name="option_7_replace_sub_3" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub3()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub4()">Replace</a>
                                            <input id="option-7-sub-4-replace-file-input" type="file" name="option_7_replace_sub_4" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub4()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub5()">Replace</a>
                                            <input id="option-7-sub-5-replace-file-input" type="file" name="option_7_replace_sub_5" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub5()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub6()">Replace</a>
                                            <input id="option-7-sub-6-replace-file-input" type="file" name="option_7_replace_sub_6" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub6()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub7()">Replace</a>
                                            <input id="option-7-sub-7-replace-file-input" type="file" name="option_7_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub7()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub8()">Replace</a>
                                            <input id="option-7-sub-8-replace-file-input" type="file" name="option_7_replace_sub_8" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub8()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-7-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit7Sub9()">Replace</a>
                                            <input id="option-7-sub-9-replace-file-input" type="file" name="option_7_replace_sub_9" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit7Sub9()" />
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
        const selectField7 = document.getElementById("cars7");
        const mp3section7 = document.getElementById("mp3-section7");
        const transfersection7 = document.getElementById("transfer-section7");
        const submenusection7 = document.getElementById("submenu-section7");

        const selectedFunction7 = "<?php echo $selectedFunction7; ?>";

        if (selectedFunction7 == 'audio') {
            mp3section7.style.display = "block";
        }
        if (selectedFunction7 == 'transfer') {
            transfersection7.style.display = "block";
        }

        if (selectedFunction7 == 'sub_menu') {
            submenusection7.style.display = "block";
        }

        function toggleSections7() {
            const selectedValue7 = selectField7.value;

            saveCurrentOption7(selectedValue7);
            mp3section7.style.display = selectedValue7 === "audio" ? "block" : "none";
            transfersection7.style.display = selectedValue7 === "transfer" ? "block" : "none";
            submenusection7.style.display = selectedValue7 === "sub_menu" ? "block" : "none";
        }

        selectField7.addEventListener("change", toggleSections7);
    });

    function saveCurrentOption7(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 7
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

    function triggerFileInputForDigit7() {
        document.getElementById("option-7-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub3() {
        // Trigger file input click
        document.getElementById("option-7-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub4() {
        // Trigger file input click
        document.getElementById("option-7-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub5() {
        // Trigger file input click
        document.getElementById("option-7-sub-5-replace-file-input").click();
    }
    function triggerFileInputForDigit7Sub6() {
        // Trigger file input click
        document.getElementById("option-7-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub7() {
        // Trigger file input click
        document.getElementById("option-7-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub8() {
        // Trigger file input click
        document.getElementById("option-7-sub-8-replace-file-input").click();
    }



    function uploadFileDigit7() {
        const fileInput = document.getElementById("option-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);

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

    function triggerFileInputForDigit7SubMenu() {
        document.getElementById("option-7-sub-menu-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub1() {
        document.getElementById("option-7-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub2() {
        document.getElementById("option-7-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit7Sub9() {
        document.getElementById("option-7-sub-9-replace-file-input").click();
    }

    function uploadFileDigit7Sub1() {
        const fileInput = document.getElementById("option-7-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub2() {
        const fileInput = document.getElementById("option-7-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub3() {
        const fileInput = document.getElementById("option-7-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub4() {
        const fileInput = document.getElementById("option-7-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub5() {
        const fileInput = document.getElementById("option-7-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub6() {
        const fileInput = document.getElementById("option-7-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub7() {
        const fileInput = document.getElementById("option-7-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub8() {
        const fileInput = document.getElementById("option-7-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7Sub9() {
        const fileInput = document.getElementById("option-7-sub-9-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 7);
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

    function uploadFileDigit7SubMenu() {
        const fileInput = document.getElementById("option-7-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "sub_menu");
            formData.append("digit", 7);
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

    function saveNumber7() {
        const numberInput = document.getElementById('number-input-7').value;
        const aferNumberInput7 = document.getElementById('afer-number-input-7').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (numberInput.trim() !== "" || aferNumberInput7.trim() !== "") {
            fetch("{{ route('call-action.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        type: "transfer",
                        number: numberInput,
                        afer_time: aferNumberInput7,
                        digit: 7,
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
