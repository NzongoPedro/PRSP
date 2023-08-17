  <!-- SECÇÃO dasbh-->
  <section class="card dash border-0 rounded-0 shadow-sm" id="dashboard">
      <div class="card-body corpo-dash">
          <!-- CARDS DE INFORMAçÃO -->
          <div class="row">
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="fade-left" data-aos-transition="1500" data-aos-durantion="2500">
                      <div class="text-center">
                          <i class="bi bi-people-fill alerta-icon"></i>
                          <h5 class="alerta-titulo">Utentes</h5>
                          <span class="alerta-num">10</span>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="fade-left" data-aos-transition="2000" data-aos-durantion="2500">
                      <div class="text-center">
                          <i class="bi bi-person-lines-fill alerta-icon"></i>
                          <h5 class="alerta-titulo">gestores</h5>
                          <span class="alerta-num">10</span>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="fade-left" data-aos-transition="2000" data-aos-durantion="2500">
                      <div class="text-center">
                          <i class="bi bi-bank2 alerta-icon"></i>
                          <h5 class="alerta-titulo">postos</h5>
                          <span class="alerta-num">10</span>
                      </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="shadow-sm alert alert-danger alert-dismissible alertas rounded-0" role="alert" data-aos="fade-left" data-aos-transition="2000" data-aos-durantion="2500">
                      <div class="text-center">
                          <i class="bi bi-person-video alerta-icon"></i>
                          <h5 class="alerta-titulo">admin</h5>
                          <span class="alerta-num">10</span>
                      </div>
                  </div>
              </div>
          </div> <!-- FIM CARDS DE INFORMAçÃO -->
          <h5 class="card-title titulo-dash">dashboard</h5>
      </div><!-- Fim card informação -->
  </section><!-- Fim secção dash -->

  <!-- Graficos    -->
  <section class="mt-2">
      <div class="row" data-aos="fade-in" data-aos-transition="2000" data-aos-durantion="2500">
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Pie Chart</h5>

                      <!-- Pie Chart -->
                      <div id="pieChart2" style="height: 400px;" class="echart"></div>

                      <script>
                          document.addEventListener("DOMContentLoaded", () => {
                              echarts.init(document.querySelector("#pieChart2")).setOption({
                                  title: {
                                      text: 'Referer of a Website',
                                      subtext: 'Fake Data',
                                      left: 'center'
                                  },
                                  tooltip: {
                                      trigger: 'item'
                                  },
                                  legend: {
                                      orient: 'vertical',
                                      left: 'left'
                                  },
                                  series: [{
                                      name: 'Access From',
                                      type: 'pie',
                                      radius: '50%',
                                      data: [{
                                              value: 1048,
                                              name: 'Search Engine'
                                          },
                                          {
                                              value: 735,
                                              name: 'Direct'
                                          },
                                          {
                                              value: 580,
                                              name: 'Email'
                                          },
                                          {
                                              value: 484,
                                              name: 'Union Ads'
                                          },
                                          {
                                              value: 300,
                                              name: 'Video Ads'
                                          }
                                      ],
                                      emphasis: {
                                          itemStyle: {
                                              shadowBlur: 10,
                                              shadowOffsetX: 0,
                                              shadowColor: 'rgba(0, 0, 0, 0.5)'
                                          }
                                      }
                                  }]
                              });
                          });
                      </script>
                      <!-- End Pie Chart -->

                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Pie Chart</h5>

                      <!-- Pie Chart -->
                      <div id="pieChart" style="height: 400px;"></div>

                      <script>
                          document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#pieChart"), {
                                  series: [44, 55, 13, 43, 22],
                                  chart: {
                                      height: 350,
                                      type: 'pie',
                                      toolbar: {
                                          show: true
                                      }
                                  },
                                  labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
                              }).render();
                          });
                      </script>
                      <!-- End Pie Chart -->

                  </div>
              </div>
          </div>
      </div>
  </section>