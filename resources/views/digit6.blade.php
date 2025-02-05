<div class="col-md-4 mt-3">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
            <?php
            $callAction6 = App\Models\CallAction::where('digit', 6)->first();
            $selectedFunction6 = $callAction6 ? $callAction6->type : null; // Get saved type
            ?>
            <label for="">Function</label>
            <select name="cars6" id="cars6" class="play form-select">
                <option value="none" {{ $selectedFunction6 == 'none' ? 'selected' : '' }}>None</option>
                <option value="audio" {{ $selectedFunction6 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                <option value="transfer" {{ $selectedFunction6 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="sub_menu" {{ $selectedFunction6 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
            </select>
        </div>

        <div id="mp3-section6" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="option-6-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit6()">Replace</a>
                <input id="option-6-replace-file-input" type="file" name="option_6_replace" style="display:none"
                    class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6()" />
            </div>
        </div>

        <!-- Transfer Section -->
        <div id="transfer-section6" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">To</label>
                    <input
                        name="number"
                        type="text"
                        value="{{ @$callAction6->transfer_to}}"
                        class="w-100"
                        placeholder="+1123355656"
                        id="number-input-6"
                        onblur="saveNumber6()" />
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter after (minutes)</label>
                    <input name="afer_time" type="number" class="w-100" value="{{ @$callAction6->afer_time}}" id="afer-number-input-6"
                    onblur="saveNumber6()" />
                </div>
            </div>
        </div>

        <!-- Submenu Section -->
        <div id="submenu-section6" class="col-md-12" style="display: none;">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop6" href="javascript:void(0)">Edit Submenu</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Digit 6 -->
<div class="modal fade" id="staticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-5">
                    <div class="container-fluid">
                        <div class="row sub-menu">
                            <div class="col-md-4 my-0">
                                <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                    <h3 class="h3">Greeting for Sub-menu 6</h3>
                                    <a id="option-6-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6SubMenu()">Replace</a>
                                    <input id="option-6-sub-menu-replace-file-input" type="file" name="option_6_replace_sub" style="display:none"
                                        class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6SubMenu()" />
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
                                            <a id="option-6-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub1()">Replace</a>
                                            <input id="option-6-sub-1-replace-file-input" type="file" name="option_6_replace_sub_1" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub1()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub2()">Replace</a>
                                            <input id="option-6-sub-2-replace-file-input" type="file" name="option_6_replace_sub_2" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub2()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub3()">Replace</a>
                                            <input id="option-6-sub-3-replace-file-input" type="file" name="option_6_replace_sub_3" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub3()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub4()">Replace</a>
                                            <input id="option-6-sub-4-replace-file-input" type="file" name="option_6_replace_sub_4" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub4()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub5()">Replace</a>
                                            <input id="option-6-sub-5-replace-file-input" type="file" name="option_6_replace_sub_5" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub5()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub6()">Replace</a>
                                            <input id="option-6-sub-6-replace-file-input" type="file" name="option_6_replace_sub_6" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub6()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub7()">Replace</a>
                                            <input id="option-6-sub-7-replace-file-input" type="file" name="option_6_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub7()" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub8()">Replace</a>
                                            <input id="option-6-sub-8-replace-file-input" type="file" name="option_6_replace_sub_8" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub8()" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                            <label for="">Function</label>
                                            <select name="cars" id="cars" class="play">
                                                <option value="volvo">Play MP3</option>
                                            </select>
                                            <a id="option-6-sub-10-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit6Sub10()">Replace</a>
                                            <input id="option-6-sub-10-replace-file-input" type="file" name="option_6_replace_sub_7" style="display:none"
                                                class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit6Sub10()" />
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
        const selectField6 = document.getElementById("cars6");
        const mp3section6 = document.getElementById("mp3-section6");
        const transfersectio6 = document.getElementById("transfer-section6");
        const submenusection6 = document.getElementById("submenu-section6");

        const selectedFunction6 = "<?php echo $selectedFunction6; ?>";

        if (selectedFunction6 == 'audio') {
            mp3section6.style.display = "block";
        }
        if (selectedFunction6 == 'transfer') {
            transfersectio6.style.display = "block";
        }

        if (selectedFunction6 == 'sub_menu') {
            submenusection6.style.display = "block";
        }

        function toggleSections6() {
            const selectedValue6 = selectField6.value;

            saveCurrentOption6(selectedValue6);
            mp3section6.style.display = selectedValue6 === "audio" ? "block" : "none";
            transfersectio6.style.display = selectedValue6 === "transfer" ? "block" : "none";
            submenusection6.style.display = selectedValue6 === "sub_menu" ? "block" : "none";
        }

        selectField6.addEventListener("change", toggleSections6);
    });

    function saveCurrentOption6(selectedValue) {
        fetch("/update-call-action", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    type: selectedValue,
                    digit: 6
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

    function triggerFileInputForDigit6() {
        document.getElementById("option-6-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub3() {
        // Trigger file input click
        document.getElementById("option-6-sub-3-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub4() {
        // Trigger file input click
        document.getElementById("option-6-sub-4-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub5() {
        // Trigger file input click
        document.getElementById("option-6-sub-5-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub6() {
        // Trigger file input click
        document.getElementById("option-6-sub-6-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub7() {
        // Trigger file input click
        document.getElementById("option-6-sub-7-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub8() {
        // Trigger file input click
        document.getElementById("option-6-sub-8-replace-file-input").click();
    }



    function uploadFileDigit6() {
        const fileInput = document.getElementById("option-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);

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

    function triggerFileInputForDigit6SubMenu() {
        document.getElementById("option-6-sub-menu-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub1() {
        document.getElementById("option-6-sub-1-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub10() {
        document.getElementById("option-6-sub-10-replace-file-input").click();
    }



    function triggerFileInputForDigit6Sub2() {
        document.getElementById("option-6-sub-2-replace-file-input").click();
    }

    function triggerFileInputForDigit6Sub9() {
        document.getElementById("option-6-sub-9-replace-file-input").click();
    }

    function uploadFileDigit6Sub1() {
        const fileInput = document.getElementById("option-6-sub-1-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub10() {
        const fileInput = document.getElementById("option-6-sub-10-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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


    function uploadFileDigit6Sub2() {
        const fileInput = document.getElementById("option-6-sub-2-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub3() {
        const fileInput = document.getElementById("option-6-sub-3-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub4() {
        const fileInput = document.getElementById("option-6-sub-4-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub5() {
        const fileInput = document.getElementById("option-6-sub-5-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub6() {
        const fileInput = document.getElementById("option-6-sub-6-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub7() {
        const fileInput = document.getElementById("option-6-sub-7-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub8() {
        const fileInput = document.getElementById("option-6-sub-8-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6Sub9() {
        const fileInput = document.getElementById("option-6-sub-9-replace-file-input");
        console.log(fileInput, 'fileInput');
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "audio");
            formData.append("digit", 6);
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

    function uploadFileDigit6SubMenu() {
        const fileInput = document.getElementById("option-6-sub-menu-replace-file-input");
        const selectedFile = fileInput.files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (selectedFile) {
            const formData = new FormData();
            formData.append("audio_file", selectedFile);
            formData.append("type", "sub_menu");
            formData.append("digit", 6);
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

    function saveNumber6() {
        const numberInput = document.getElementById('number-input-6').value;
        const aferNumberInput6 = document.getElementById('afer-number-input-6').value;
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
                        afer_time: aferNumberInput6,
                        digit: 6,
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
