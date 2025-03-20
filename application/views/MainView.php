<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>XTrakr</title>
  <link rel="icon" href="<?= base_url() ?>assets/image/xtrackr-icon.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/mdb/css/mdb.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/mdb/css/admin.css" />
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" -->
  <!-- crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
</head>

<style>
  .h2 {
    text-align: center;
    color: #333;
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  input[type="text"],
  input[type="number"],
  input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background: #218838;
  }

  #interactive {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: auto;
    display: none;
  }

  video {
    width: 100%;
    height: auto;
  }

  #result {
    margin-top: 20px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
  }

  #startButton {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }

  @media screen and (max-width: 600px) {
    #mobile-view {
      display: block;
    }

    #desktop-view {
      display: none;
    }
  }

  @media screen and (min-width: 600px) {
    #mobile-view {
      display: none;
    }

    #desktop-view {
      display: block;
    }

  }

  .tool-card:hover {
    transform: scale(1.02);
  }

  .active-list {
    color: #3b71ca;
  }
</style>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="#" class="list-group-item list-group-item-action py-2 active" data-content="dashboard" data-mdb-ripple-init aria-current="true">
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2" data-content="borrow-tools" data-mdb-ripple-init>
            <i class="fas fa-toolbox fa-fw me-3"></i><span>Borrow Tools</span>
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2" data-content="borrow-history" data-mdb-ripple-init><i
              class="fas fa-history fa-fw me-3"></i><span>Borrowed History</span></a>
          <?php if ($this->session->userdata('role') == 1): ?>
            <a href="#" class="list-group-item list-group-item-action py-2" data-content="tool-registration" data-mdb-ripple-init><i
                class="fas fa-plus fa-fw me-3"></i><span>Tool Registration</span></a>
            <a href="#" class="list-group-item list-group-item-action py-2" data-content="tool-approval" data-mdb-ripple-init><i
                class="fas fa-checklist fa-fw me-3"></i><span>Tool Approval</span></a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars" style="float: left;"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <img src="<?= base_url() ?>assets/image/xtrackr-logo.png" height="25" alt="" loading="lazy" />
        </a>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-dropdown-init aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else</a>
              </li>
            </ul>
          </li>



          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
              <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
                alt="" loading="lazy" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" id="logout" href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <section id="dashboard" class="content-display">
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-info"><?= count($all_tools) ?></h3>
                    <p class="mb-0">Total tools</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-wrench text-info fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">
                      <?= count(array_filter(array_map(function ($tool) {
                        return $tool->isBorrowed == 0 ? 1 : 0;
                      }, $all_tools))) ?>
                    </h3>
                    <p class="mb-0">Available</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-wrench text-success fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-warning">
                      <?= count(array_filter(array_map(function ($tool) {
                        return $tool->isBorrowed == 1 ? 1 : 0;
                      }, $all_tools))) ?>
                    </h3>
                    <p class="mb-0">Barrowed</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-wrench text-warning fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-danger">3</h3>
                    <p class="mb-0">Loss tools</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-wrench text-danger fa-3x"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section id="borrow-tools" class="content-display" style="display: none;">
        <h3>Borrow tool</h3>
        <span style="float: right;">
          <i class="fas fa-list fa-2x choose-list" data-show="table"></i>
          <i class="fa-solid fa-image fa-2x choose-list active-list" data-show="card"></i>
        </span>
        <div style="margin: 20px;" id="borrow-tools-filter">
          <div id="mobile-view">
            <button id="startButton">Start Scan</button>
            <div id="interactive" class="viewport"></div>
            <p id="result"></p>
          </div>
          <div id="desktop-view">
            <label for="">Enter Key word</label>
            <div class="row">
              <div class="col-md-6">
                <input type="text" id="tool_id" name="tool_id" placeholder="Type here">
              </div>
              <div class="col-md-2">
                <select name="category" id="category" class="form-control">
                  <option value="" selected disabled>--select category--</option>
                  <option value="all">All</option>
                  <option value="1">Handy Tools</option>
                  <option value="2">Power Tools</option>
                  <option value="3">Measuring Tools</option>
                  <option value="4">Electrical</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row borrowed-tools-list" id="card_display">
            <center><span id="result_search"></span></center>
            <?php foreach ($all_tools as $key_tool => $tool): ?>
              <div class="col-md-3 tool-card-display">
                <div class="card m-2 tool-card" data-catid="<?= $tool->CategoryId ?>" data-toolname="<?= $tool->ToolName ?>" data-category="<?= $tool->CategoryName ?>" data-barcode="<?= $tool->BarcodeId ?>">
                  <style scope>
                    .tool-card img {
                      height: 100%;
                      width: auto;
                      object-fit: contain;
                    }
                  </style>
                  <?php if (!empty($tool->ImageName)): ?>
                    <img src="<?= base_url() ?>assets/tool_image/<?= $tool->ImageName ?>" class="card-img-top" alt="Fissure in Sandstone" />
                  <?php else: ?>
                    <img src="<?= base_url() ?>assets/tool_image/default.png" class="card-img-top" alt="Fissure in Sandstone" />
                  <?php endif; ?>
                  <div class="card-body">
                    <h5 class="card-title"> <span style="color:<?= $tool->isBorrowed == 0 ? 'green' : 'orange'  ?>"><?= $tool->ToolName ?></span> | <?= $tool->CategoryName ?></h5>
                    <span style="font-size: 12px;">ID:<?= $tool->BarcodeId ?></span>
                    <p class="card-text" style="font-size:12px"><?= $tool->Description ?></p>
                    <hr>
                    <?php

                    echo   !empty(_getToolStatusById($tool->id)->BorrowedBy)
                      ?
                      '<span class="card-text" style="font-size:12px">Borrowed by: ' . _getToolStatusById($tool->id)->BorrowedBy . '</span><br>
                     <span class="card-text" style="font-size:12px">Borrowed date: ' . date('M d,Y', strtotime(_getToolStatusById($tool->id)->BorrowedDate)) . '</span>'

                      : '<p class="card-text" style="font-size:12px">Tool is available</p>';
                    if ($_SESSION['role'] != 1):
                      if ($tool->isBorrowed == 0): ?>
                        <a href="#!" class="btn btn-info borrow-tool-class tool-<?= $tool->BarcodeId ?>" data-mdb-ripple-init data-toolid="<?= $tool->id ?>" data-barcodeid="<?= $tool->BarcodeId ?>">Borrow</a>
                      <?php else: ?>

                        <a href="#!" class="btn <?= _getToolStatusById($tool->id)->class ?>" data-mdb-ripple-init><?= _getToolStatusById($tool->id)->BorrowedBy == $_SESSION['username'] ?    _getToolStatusById($tool->id)->StatusName : 'Not Available' ?></a>

                    <?php endif;
                    endif;
                    ?>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>

          <div class="row borrowed-tools-list" id="table_display" style="display: none;">
            <table class="table" id="borrowed-tools-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tool Name</th>
                  <th>Status</th>
                  <th>Borrower</th>
                  <th>Borrowed Date</th>
                </tr>

              </thead>
              <tbody>
                <?php foreach ($all_tools as $key_tool => $tool):
                ?>
                  <tr>
                    <td><?= $tool->id ?></td>
                    <td><?= $tool->ToolName ?></td>
                    <td><?php
                        if (!empty(_getToolStatusById($tool->id))) {
                          echo _getToolStatusById($tool->id)->BorrowedBy == $_SESSION['username'] ?    _getToolStatusById($tool->id)->StatusName : 'Not Available';
                        } else {
                          echo 'Available';
                        }

                        ?></td>
                    <td><?= '--' ?></td>
                    <td><?= '--'  ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>


      <section id="borrow-history" class="content-display" style="display: none;">
        <h3>Borrow history</h3>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tool Name</th>
              <th>Borrowed Date</th>
              <th>Return Date</th>
              <th>Borrower</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_borrowed as $key_borr => $borrowed): ?>
              <tr>
                <td><?= $borrowed->ToolBarCode ?></td>
                <td><?= $borrowed->ToolId ?></td>
                <td><?= $borrowed->BorrowedDate ?></td>
                <td><?= $borrowed->ReturnedDate ?></td>
                <td><?= $borrowed->BorrowedBy ?></td>
                <td><?= empty($borrowed->ReturnedDate) ? "<button data-barcode='{$borrowed->ToolBarCode}' data-toolid='{$borrowed->ToolId}' data-id='{$borrowed->id}' class='btn btn-danger return-tool'>Return Tool</button>" : 'Returned'  ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>


      <section id="tool-registration" class="content-display" style="display: none;">

        <div class="card p-5">
          <h2 class="h2">Tool Registration Form</h2>
          <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="tool_name">Tool Name</label>
              <input type="text" id="tool_name" name="tool_name" required>
            </div>
            <div class="form-group">
              <label for="tool_id">Tool ID</label>
              <input type="text" id="tool_id" name="tool_id" required>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
              <label for="file">Upload Tool Image</label>
              <input type="file" id="file" name="file" required>
            </div>
            <button type="submit">Register Tool</button>
          </form>
        </div>

      </section>
    </div>
  </main>
  <!--Main layout-->
  <!-- MDB -->
  <script type="text/javascript" src="<?= base_url() ?>assets/mdb/js/mdb.umd.min.js"></script>
  <!-- Custom scripts -->
  <!-- <script type="text/javascript" src="<?= base_url() ?>assets/mdb/js/admin.js"></script> -->
  <script type="text/javascript" src="<?= base_url() ?>assets/cdn_file/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/custom_file/js/scanner.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script>
    let scanning = false; // Flag to prevent multiple detections
    var isMobile = /Mobi|Android/i.test(navigator.userAgent);
    var base_url = "<?= base_url() ?>";
    $('#borrowed-tools-table').DataTable();
    document.getElementById("startButton").addEventListener("click", function() {
      document.getElementById("startButton").style.display = "none";
      document.getElementById("interactive").style.display = "block";
      startScanner();
    });

    function startScanner() {
      Quagga.init({
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector("#interactive"),
          constraints: {
            facingMode: "environment",
            width: {
              ideal: 1280
            },
            height: {
              ideal: 720
            }
          }
        },
        decoder: {
          readers: ["ean_reader", "code_128_reader", "upc_reader"]
        }
      }, function(err) {
        if (err) {
          console.error("Quagga initialization failed:", err);
          return;
        }
        Quagga.start();
        console.log("Quagga started successfully");
      });

      Quagga.onDetected(function(data) {
        if (data && data.codeResult && data.codeResult.code) {
          if (!scanning) {
            scanning = true; // Prevent multiple detections
            let scannedCode = data.codeResult.code;
            console.log("Scanned Code:", scannedCode);
            searchTool(scannedCode)
            document.getElementById("result").innerText = "Scanned Code: " + scannedCode;
            document.getElementById("startButton").style.display = "block";
            document.getElementById("interactive").style.display = "none"; // Hide camera
            Quagga.stop();
            setTimeout(() => {
              scanning = false; // Reset flag
              Quagga.start(); // Restart scanning
            }, 2000);
          }
        } else {
          console.warn("No valid barcode detected");
        }
      });
    }
    $('.choose-list').on('click', function() {
      var show = $(this).data('show');

      $('.choose-list').removeClass('active');
      $(this).addClass('active');
      $('.borrowed-tools-list').hide();
      $('#' + show + '_display').show();
      if (show == 'card') {
        $('#borrow-tools-filter').show();
      } else {
        $('#borrow-tools-filter').hide();
      }

    })
    $(document).ready(function() {
      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
      });

      $('.list-group-item-action').on('click', function() {
        $('.list-group-item-action').removeClass('active');
        $(this).addClass('active');
        var content = $(this).data('content');
        $('.content-display').hide();
        console.log(content);
        $('#' + content).show();
        if (isMobile === true) {
          $('.navbar-toggler').click();
        }

      });


      $('#tool_id').on('keyup', function() {
        var scannedCode = $('#tool_id').val();
        searcKey(scannedCode);
      })
      $('#category').on('change', function() {
        var scannedCode = $('#category').val();
        searcCategory(scannedCode);
      })

      $('.borrow-tool-class').on('click', function() {
        var scannedCode = $(this).data('barcodeid');
        var toolid = $(this).data('toolid');

        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, borrow it!"
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: base_url + "borrow-tool",
              method: "POST",
              data: {
                barCode: scannedCode,
                toolid: toolid
              },
              dataType: "json",
              success: function(response) {
                console.log(response);
                if (response.code == 200) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // location.reload();
                    }
                  });
                  $('.tool-' + scannedCode).removeClass('btn-info');
                  $('.tool-' + scannedCode).addClass('btn-warning');
                  $('.tool-' + scannedCode).text('FOR APPROVAL');
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                  });
                }
              }
            });
          }
        });
      })

    });
    $(document).on('click', '.return-tool', function() {
      var barcode = $(this).data('barcode');
      var toolid = $(this).data('toolid');
      var request_id = $(this).data('id');

      Swal.fire({
        title: "Are you sure?",
        text: "Please confirm if you want to return!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, return it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: base_url + "return-tool",
            method: "POST",
            data: {
              barCode: barcode,
              toolid: toolid,
              request_id:request_id
            },
            dataType: "json",
            success: function(response) {
              Swal.fire({
                title: "Tool has been returned!",
                text: "page will be reloaded.",
                icon: "success"
              });

            }
          })
        }
      });
    })
    $(document).on('click', '#logout', function() {
      Swal.fire({
        title: "You want to logout?",
        text: "Please confirm if you want to logout!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout!"
      }).then((result) => {
        if (result.isConfirmed) {
          location.href = base_url + "logout";
        }
      });
    })

    function searcCategory(scannedCode) {
      var count = 0;
      var search_input = $('#tool_id').val();
      if (scannedCode === 'all') {
        $('.tool-card-display').show();
        $('#result_search').html('');
      } else {
        $('.tool-card-display').hide();
        $.each($('.tool-card'), function(index, value) {
          var catid = $(this).data('catid');
          if (catid == scannedCode) {
            $(this).parent().show();
            count++;
          }
        });
        $('#result_search').html(count + ' tools found');
      }
    }


    function searcKey(scannedCode) {
      var count = 0;
      var selectedCategory = $('#category').val();
      if (scannedCode == '' && selectedCategory == 'all') {
        $('.tool-card-display').show();
        $('#result_search').html('');
      } else {
        $('.tool-card-display').hide();
        $.each($('.tool-card'), function(index, value) {
          var category = $(this).data('category');
          var toolname = $(this).data('toolname');
          var barcode = $(this).data('barcode');
          var catid = $(this).data('catid');

          console.log(category, toolname, barcode, selectedCategory);
          if (selectedCategory == 'all') {
            if (category.toLowerCase().includes(scannedCode.toLowerCase()) || toolname.toLowerCase().includes(scannedCode.toLowerCase()) || barcode == scannedCode) {
              $(this).parent().show();
              count++;
            }
          } else {
            if (catid == selectedCategory && (category.toLowerCase().includes(scannedCode.toLowerCase()) || toolname.toLowerCase().includes(scannedCode.toLowerCase()) || barcode == scannedCode)) {
              $(this).parent().show();
              count++;
            }
          }
        })
        $('#result_search').html(count + ' tools found');
      }

    }

    function searchTool(scannedCode) {
      var count = 0;
      $('.tool-card-display').hide();
      $.each($('.tool-card'), function(index, value) {
        var barcode = $(this).data('barcode');
        if (barcode == scannedCode) {
          $(this).parent().show();
          count++;
        }
      })
      $('#result_search').html(count + ' tools found');
    }
  </script>



</body>

</html>