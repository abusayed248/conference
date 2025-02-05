<x-app-layout>

    <div class="mt-5">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row sub-menu">
                <div class="col-md-4 my-0">
                    <form action="{{ route('greetings.updateAudio') }}" method="POST" enctype="multipart/form-data">
                        <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                            <h3 class="h3">Greeting for Subscribers</h3>

                            @csrf
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="col-md-1">
                                    <label id="file-name" for="file-input"> File</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="custom-file mx-3">
                                        <label id="file-name" class="file-label play" for="file-input">choose File</label>
                                        <input type="file" id="file-input" accept="audio/mp3,audio/*;capture=microphone" name="audio_file" class="file-input" />

                                        <input id="replace-file-input" name="type" type="hidden" style="display:none" value="greetings" class="replace-img" />

                                        <!-- <input type="file" name="audio_file" id="file-input" class="form-control" accept="audio/mp3,audio/wav"> -->
                                    </div>
                                </div>

                            </div>
                            <button id="replace-file-text" type="submit" class="text-decoration  no-style">Replace</button>
                        </div>
                    </form>


                    <form action="{{ route('greetings.updateAudioNonSubscribtion') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex mt-5 justify-content-center flex-column align-items-center">
                            <h3 class="h3">Greeting for non-subscribers</h3>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="col-md-1">
                                    <label id="file-name-non-subscribers" for="file-input-non-subscribers"> File</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="custom-file mx-3">
                                        <label id="file-label-non-subscribers" class="file-label play" for="file-input-non-subscribers">choose File</label>

                                        <input type="file" id="file-input-non-subscribers" accept="audio/mp3,audio/*;capture=microphone" name="audio_file" class="file-input" />

                                        <input id="replace-file-input-non-subscribers" name="type" type="hidden" style="display:none" value="non_subscriber_greetings" class="replace-img" />
                                    </div>
                                </div>
                            </div>
                            <button id="replace-file-non-sub-text" type="submit" class="text-decoration no-style">Replace</button>
                        </div>
                    </form>


                    <!-- <input id="replace-non-file-input" accept="audio/mp3,audio/*;capture=microphone" name="non_sub_audio" type="file" style="display:none" class="replace-img" /> -->


                    <div class="mt-5 d-flex justify-content-center">
                        <h3><a class="text-center large-text text-decoration" href="{{ route('manage.subscribers') }}">Manage Subscribers</a></h3>
                    </div>
                </div>

                <div class="col-md-8 py-5 bg-green-600">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="d-flex align-items-center mt-2 w-100">
                                    <?php
                                    $callAction1 = App\Models\CallAction::where('digit', 1)->first();
                                    $selectedFunction1 = $callAction1 ? $callAction1->type : null; // Get saved type

                                    ?>
                                    <label for="">Function</label>
                                    <select name="cars" id="cars1" class="play form-select">
                                        <option value="none" {{ $selectedFunction1 == 'none' ? 'selected' : '' }}>None</option>
                                        <option value="audio" {{ $selectedFunction1 == 'audio' ? 'selected' : '' }}>Play MP3</option>
                                        <option value="transfer" {{ $selectedFunction1 == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                        <option value="sub_menu" {{ $selectedFunction1 == 'sub_menu' ? 'selected' : '' }}>Submenu</option>
                                    </select>
                                </div>

                                <div id="mp3-section1" class="col-md-12" style="display: none;">
                                    <div class="d-flex align-items-center flex-column">
                                        <a id="option-1-replace-file-text" class="text-decoration" href="javascript:void(0)" onclick="triggerFileInputForDigit1()">Replace</a>
                                        <input id="option-1-replace-file-input" type="file" name="option_1_replace" style="display:none"
                                            class="replace-img" accept="audio/mp3,audio/*;capture=microphone" onchange="uploadFileDigit1()" />
                                    </div>
                                </div>

                                <!-- Transfer Section -->
                                <div id="transfer-section1" class="col-md-12" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label for="">To</label>

                                            <input
                                                name="number"
                                                type="text"
                                                value="{{ @$callAction1->transfer_to}}"
                                                class="w-100"
                                                placeholder="+1123355656"
                                                id="number-input-1"
                                                onblur="saveNumber1()" />
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                                            <label for="">Enter after (minutes)</label>
                                            <input name="afer_time" type="number" class="w-100" id="afer-number-input-1" placeholder="60" value="{{ @$callAction1->afer_time}}" onblur="saveNumber1()"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submenu Section -->
                                <div id="submenu-section1" class="col-md-12" style="display: none;">
                                    <div class="d-flex align-items-center flex-column">
                                        <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="javascript:void(0)">Edit Submenu</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @include('digit2')
                        @include('digit3')
                        @include('digit4')
                        @include('digit5')
                        @include('digit6')
                        @include('digit7')
                        @include('digit8')
                        @include('digit9')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="mt-5">
                        <div class="container-fluid">

                            <div class="row sub-menu">
                                <div class="col-md-4 my-0">
                                    <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                                        <h3 class="h3">Greeting for Sub-menu</h3>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="col-md-1">
                                                <label id="file-name" for="file-input"> File</label>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="custom-file mx-3">
                                                    <label id="file-name" class="file-label play" for="file-input">choose File</label>
                                                    <input type="file" id="file-input" class="file-input" />
                                                </div>
                                            </div>
                                        </div>

                                        <a id="option-1-sub-menu-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1SubMenu()">Replace</a>
                                        <input
                                            id="option-1-sub-menu-replace-file-input"
                                            type="file"
                                            name="option_6_replace"
                                            style="display:none"
                                            class="replace-img"
                                            accept="audio/mp3,audio/*;capture=microphone"
                                            onchange="uploadFileDigit1SubMenu()" />
                                    </div>

                                </div>

                                <div class="col-md-8 py-5 bg-green-600">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>
                                                </div>
                                                <a id="option-1-sub-1-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub1()">Replace</a>
                                                <input
                                                    id="option-1-sub-1-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub1()" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>
                                                </div>


                                                <a id="option-1-sub-2-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub2()">Replace</a>
                                                <input
                                                    id="option-1-sub-2-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub2()" />
                                            </div>

                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>
                                                </div>
                                                <a id="option-1-sub-3-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub3()">Replace</a>
                                                <input
                                                    id="option-1-sub-3-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub3()" />
                                            </div>

                                        </div>

                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-4-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub4()">Replace</a>
                                                <input
                                                    id="option-1-sub-4-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub4()" />
                                            </div>

                                        </div>
                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-5-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub5()">Replace</a>
                                                <input
                                                    id="option-1-sub-5-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_1"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub5()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-6-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub6()">Replace</a>
                                                <input
                                                    id="option-1-sub-6-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_6"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub6()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-7-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub7()">Replace</a>
                                                <input
                                                    id="option-1-sub-7-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_7"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub7()" />
                                            </div>

                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-8-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub8()">Replace</a>
                                                <input
                                                    id="option-1-sub-8-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_8"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit1Sub8()" />
                                            </div>
                                        </div>


                                        <div class="col-md-4 mt-5 ">
                                            <div class="d-flex align-items-center flex-column">
                                                <div class="d-flex align-items-center mt-2 w-100">
                                                    <label for="">Function</label>
                                                    <select name="cars" id="cars" form="" class="play">
                                                        <option value="volvo">Play MP3</option>
                                                    </select>

                                                </div>
                                                <a id="option-1-sub-9-replace-file-text" class="text-decoration no-style" href="javascript:void(0)" onclick="triggerFileInputForDigit1Sub9()">Replace</a>
                                                <input
                                                    id="option-1-sub-9-replace-file-input"
                                                    type="file"
                                                    name="option_6_replace_sub_9"
                                                    style="display:none"
                                                    class="replace-img"
                                                    accept="audio/mp3,audio/*;capture=microphone"
                                                    onchange="uploadFileDigit6Sub9()" />
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
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectField1 = document.getElementById("cars1");
            const mp3Section1 = document.getElementById("mp3-section1");
            const transferSection1 = document.getElementById("transfer-section1");
            const submenuSection1 = document.getElementById("submenu-section1");


            const selectedFunction1 = "<?php echo $selectedFunction1; ?>";

            if (selectedFunction1 == 'audio') {
                mp3Section1.style.display = "block";
            }
            if (selectedFunction1 == 'transfer') {
                transferSection1.style.display = "block";
            }

            if (selectedFunction1 == 'sub_menu') {
                submenuSection1.style.display = "block";
            }

            function toggleSections1() {
                const selectedValue1 = selectField1.value;
                saveCurrentOption1(selectedValue1);
                mp3Section1.style.display = selectedValue1 === "audio" ? "block" : "none";
                transferSection1.style.display = selectedValue1 === "transfer" ? "block" : "none";
                submenuSection1.style.display = selectedValue1 === "sub_menu" ? "block" : "none";
            }

            selectField1.addEventListener("change", toggleSections1);




        });


        function saveCurrentOption1(selectedValue) {
            fetch("/update-call-action", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        type: selectedValue,
                        digit: 1
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


        function triggerFileInputForDigit1() {
            // Correct ID
            document.getElementById("option-1-replace-file-input").click();
        }

        function uploadFileDigit1() {
            const fileInput = document.getElementById("option-1-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data

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


        function triggerFileInputForDigit3() {
            // Trigger file input click
            document.getElementById("option-3-replace-file-input").click();
        }

        function triggerFileInputForDigit1SubMenu() {
            // Trigger file input click
            document.getElementById("option-1-sub-menu-replace-file-input").click();
        }


        function triggerFileInputForDigit1Sub1() {
            // Trigger file input click
            document.getElementById("option-1-sub-1-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub2() {
            // Trigger file input click
            document.getElementById("option-1-sub-2-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub3() {
            // Trigger file input click
            document.getElementById("option-1-sub-3-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub4() {
            // Trigger file input click
            document.getElementById("option-1-sub-4-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub5() {
            // Trigger file input click
            document.getElementById("option-1-sub-5-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub6() {
            // Trigger file input click
            document.getElementById("option-1-sub-6-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub7() {
            // Trigger file input click
            document.getElementById("option-1-sub-7-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub8() {
            // Trigger file input click
            document.getElementById("option-1-sub-8-replace-file-input").click();
        }

        function triggerFileInputForDigit1Sub9() {
            // Trigger file input click
            document.getElementById("option-1-sub-9-replace-file-input").click();
        }

        function uploadFileDigit1Sub1() {
            const fileInput = document.getElementById("option-1-sub-1-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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


        function uploadFileDigit1Sub2() {
            const fileInput = document.getElementById("option-1-sub-2-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub3() {
            const fileInput = document.getElementById("option-1-sub-3-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub4() {
            const fileInput = document.getElementById("option-1-sub-4-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub5() {
            const fileInput = document.getElementById("option-1-sub-5-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub6() {
            const fileInput = document.getElementById("option-1-sub-6-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub7() {
            const fileInput = document.getElementById("option-1-sub-7-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit1Sub8() {
            const fileInput = document.getElementById("option-1-sub-8-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit6Sub9() {
            const fileInput = document.getElementById("option-1-sub-9-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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


        function uploadFileDigit1SubMenu() {
            const fileInput = document.getElementById("option-1-sub-menu-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "sub_menu"); // Add any other required data
                formData.append("digit", 1); // Add any other required data
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

        function uploadFileDigit3() {
            const fileInput = document.getElementById("option-3-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 3); // Add any other required data

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
                            alert("File uploaded successfully.");
                        } else {
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


        function triggerFileInputForDigit4() {
            // Trigger file input click
            document.getElementById("option-4-replace-file-input").click();
        }

        function uploadFileDigit4() {
            const fileInput = document.getElementById("option-4-replace-file-input");
            const selectedFile = fileInput.files[0];
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (selectedFile) {
                const formData = new FormData();
                formData.append("audio_file", selectedFile); // Append the selected file
                formData.append("type", "audio"); // Add any other required data
                formData.append("digit", 4); // Add any other required data

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





        function saveNumber(digit, afer) {
            const numberInput = document.getElementById('number-input').value;
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
                            afer_: afer, // Adjust as needed
                            digit: digit, // Adjust as needed
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

        function saveNumber1() {
            const numberInput = document.getElementById('number-input-1').value;
            const aferNumberInput = document.getElementById('afer-number-input-1').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (numberInput.trim() !== "" || aferNumberInput.trim() !== "") {
                fetch("{{ route('call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            type: "transfer", // Replace with the actual type value
                            number: numberInput,
                            afer_time: aferNumberInput, // Adjust as needed
                            digit: 1, // Adjust as needed
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


        function saveNumber9() {
            const numberInput = document.getElementById('number-input-9').value;
            const aferNumberInput9 = document.getElementById('afer-number-input-9').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (numberInput.trim() !== "" || aferNumberInput9.trim() !== "") {
                fetch("{{ route('call-action.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify({
                            type: "transfer", // Replace with the actual type value
                            number: numberInput,
                            afer_time: aferNumberInput9, // Adjust as needed
                            digit: 9, // Adjust as needed
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


</x-app-layout>
