   <!-- Content wrapper -->
   <?php
    if (isset($_SESSION['token-posto']) && isset($_SESSION['id-posto'])) : ?>

       <div class="content-wrapper">
           <!-- Content -->

           <div class="container-xxl flex-grow-1 container-p-y">
               <div class="row">
                   <!--/ Total Revenue -->
                   <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                       <div class="row">
                           <div class="col mb-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="card-title d-flex align-items-start justify-content-between">
                                           <div class="avatar flex-shrink-0">
                                               <i class='bx bxs-data bx-lg'></i>
                                           </div>
                                       </div>
                                       <span class="d-block mb-1">Registros</span>
                                       <h3 class="card-title text-nowrap mb-2">
                                           <?= number_format($contador['num_documentos'] + $contador['num_solicitacoes']) ?>
                                       </h3>
                                       <small class="cor-primario fw-semibold">no total</small>
                                   </div>
                               </div>
                           </div>
                           <div class="col mb-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="card-title d-flex align-items-start justify-content-between">
                                           <div class="avatar flex-shrink-0">
                                               <i class='bx bxs-user-plus bx-lg'></i>
                                           </div>
                                       </div>
                                       <span class="d-block mb-1">Solicitações</span>
                                       <h3 class="card-title text-nowrap mb-2"><?= number_format($contador['num_solicitacoes']) ?></h3>
                                       <small class="cor-primario fw-semibold"> registros</small>
                                   </div>
                               </div>
                           </div>
                           <div class="col mb-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="card-title d-flex align-items-start justify-content-between">
                                           <div class="avatar flex-shrink-0">
                                               <i class='bx bx-list-check bg-lg'></i>
                                           </div>
                                       </div>
                                       <span class="d-block mb-1">Relatórios</span>
                                       <h3 class="card-title text-nowrap mb-2">0</h3>
                                       <small class="cor-primario fw-semibold"> registros</small>
                                   </div>
                               </div>
                           </div>
                           <div class="col mb-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="card-title d-flex align-items-start justify-content-between">
                                           <div class="avatar flex-shrink-0">
                                               <i class='bx bx-building-house bx-lg'></i>
                                           </div>
                                       </div>
                                       <span class="d-block mb-1">Posto</span>
                                       <h3 class="card-title text-nowrap mb-2">1</h3>
                                       <small class="cor-primario fw-semibold"> registros</small>
                                   </div>
                               </div>
                           </div>
                           <div class="col mb-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="card-title d-flex align-items-start justify-content-between">
                                           <div class="avatar flex-shrink-0">
                                               <i class='bx bxs-file-doc bx-lg'></i>
                                           </div>
                                       </div>
                                       <span class="d-block mb-1">Documentos</span>
                                       <h3 class="card-title text-nowrap mb-2"><?= number_format($contador['num_documentos']) ?></h3>
                                       <small class="cor-primario fw-semibold"> registros</small>
                                   </div>
                               </div>
                           </div>

                       </div>
                   </div>
               </div>

               <div class="row">
                   <!-- Order Statistics -->
                   <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                       <div class="card h-100">
                           <div class="card-header d-flex align-items-center justify-content-between pb-0">
                               <div class="card-title mb-0">
                                   <h5 class="m-0 me-2">Dados do sistema</h5>
                                   <small class="text-muted">representação grafíca</small>
                               </div>
                           </div>
                           <div class="card-body">
                               <div class="d-flex justify-content-between align-items-center mb-3">
                                   <div class="d-flex flex-column align-items-center gap-1">
                                       <h2 class="mb-2">Total de </h2>
                                       <span> <?= number_format($contador['num_documentos'] + $contador['num_solicitacoes']) ?></span>
                                   </div>
                                   <div id="orderStatisticsChart"></div>
                               </div>
                               <ul class="p-0 m-0">
                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <h6 class="mb-0">Posto</h6>
                                           </div>
                                           <div class="user-progress">
                                               <small class="fw-semibold">1</small>
                                           </div>
                                       </div>
                                   </li>
                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <h6 class="mb-0">Solicitações</h6>
                                           </div>
                                           <div class="user-progress">
                                               <small class="fw-semibold"><?= number_format($contador['num_solicitacoes']) ?></small>
                                           </div>
                                       </div>
                                   </li>
                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <h6 class="mb-0">Documentos</h6>
                                           </div>
                                           <div class="user-progress">
                                               <small class="fw-semibold"><?= number_format($contador['num_documentos']) ?></small>
                                           </div>
                                       </div>
                                   </li>

                                   <li class="d-flex">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <h6 class="mb-0">Relatórios</h6>
                                           </div>
                                           <div class="user-progress">
                                               <small class="fw-semibold">1</small>
                                           </div>
                                       </div>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <!--/ Order Statistics -->

                   <!-- Expense Overview -->
                   <div class="col-md-6 col-lg-4 order-1 mb-4">
                       <div class="card h-100">

                           <div class="card-body px-0">
                               <div class="tab-content p-0">
                                   <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                       <div class="d-flex p-4 pt-3">
                                           <div class="avatar flex-shrink-0 me-3">
                                               <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                                           </div>
                                           <div>
                                               <small class="text-muted d-block">Solicitações de reservas</small>
                                               <div class="d-flex align-items-center">
                                                   <h6 class="mb-0 me-1">Represet. Gráfica</h6>
                                               </div>
                                           </div>
                                       </div>
                                       <div id="incomeChart"></div>

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!--/ Expense Overview -->

                   <!-- Transactions -->
                   <div class="col-md-6 col-lg-4 order-2 mb-4">
                       <div class="card h-100">
                           <div class="card-header d-flex align-items-center justify-content-between">
                               <h5 class="card-title m-0 me-2">Relatórios</h5>
                           </div>
                           <div class="card-body">
                               <ul class="p-0 m-0">

                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <small class="text-muted d-block mb-1">Diários</small>
                                               <h6 class="mb-0">Total de </h6>
                                           </div>
                                           <div class="user-progress d-flex align-items-center gap-1">
                                               <h6 class="mb-0"></h6>
                                               <span class="text-muted">0</span>
                                           </div>
                                       </div>
                                   </li>
                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <small class="text-muted d-block mb-1">Semanais</small>
                                               <h6 class="mb-0">Total de </h6>
                                           </div>
                                           <div class="user-progress d-flex align-items-center gap-1">
                                               <h6 class="mb-0"></h6>
                                               <span class="text-muted">0</span>
                                           </div>
                                       </div>
                                   </li>
                                   <li class="d-flex mb-4 pb-1">
                                       <div class="avatar flex-shrink-0 me-3">
                                           <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
                                       </div>
                                       <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                           <div class="me-2">
                                               <small class="text-muted d-block mb-1">Mensais</small>
                                               <h6 class="mb-0">Total de </h6>
                                           </div>
                                           <div class="user-progress d-flex align-items-center gap-1">
                                               <h6 class="mb-0"></h6>
                                               <span class="text-muted">0</span>
                                           </div>
                                       </div>
                                   </li>

                               </ul>
                           </div>
                       </div>
                   </div>
                   <!--/ Transactions -->
               </div>
           </div>
           <!-- / Content -->

           <!-- Footer -->
           <?php require '../pages/footer.php'; ?>
           <!-- / Footer -->

           <div class="content-backdrop fade"></div>
       </div>
   <?php endif ?>
   <!-- Content wrapper -->