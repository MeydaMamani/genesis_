<section class="timeline">
    <div class="arrows">
        <button class="arrow arrow__prev disabled" disabled>
            <span class="mdi mdi-arrow-left-drop-circle text-pink font-30" disabled></span>
        </button>
        <button class="arrow arrow__next">
            <span class="mdi mdi-arrow-right-drop-circle text-pink font-30"></span>
        </button>
    </div>
    <ol>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #fad3ce;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_0m.png" alt="" width="60">
                </div>
                <div class="col-md-7">
                    <time>0 Meses</time>
                    <div>
                        <b>1° Cntrl:</b>
                        <span class="text-dark" v-if="listsKids.PRIMER_CNTRL != null"> [[ listsKids.PRIMER_CNTRL ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>2° Cntrl:</b>
                        <span class="text-dark" v-if="listsKids.SEG_CNTRL != null"> [[ listsKids.SEG_CNTRL ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>3° Cntrl:</b>
                        <span class="text-dark" v-if="listsKids.TER_CNTRL != null"> [[ listsKids.TER_CNTRL ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>4° Cntrl:</b>
                        <span class="text-dark" v-if="listsKids.CUAR_CNTRL != null"> [[ listsKids.CUAR_CNTRL ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #fbd0bf;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_1m.png" alt="" width="90">
                </div>
                <div class="col-md-7">
                    <time>1 - 2 Meses</time>
                    <div>
                        <b>1° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED1 != null"> [[ listsKids.CRED1 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>2° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED2 != null"> [[ listsKids.CRED2 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Antineumo:</b>
                        <span class="text-dark" v-if="listsKids.NEUMOCOCICA1 != null"> [[ listsKids.NEUMOCOCICA1 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Rotavirus:</b>
                        <span class="text-dark" v-if="listsKids.ROTAVIRUS1 != null"> [[ listsKids.ROTAVIRUS1 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Antipolio:</b>
                        <span class="text-dark" v-if="listsKids.ANTIPOLIO1 != null"> [[ listsKids.ANTIPOLIO1 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Pentavalente:</b>
                        <span class="text-dark" v-if="listsKids.PENTAVALENTE1 != null"> [[ listsKids.PENTAVALENTE1 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #fefaca;">
                <div class="col-md-5">
                    <img src="./img/detalle_ninio/baby_3m.png" alt="" width="100">
                </div>
                <div class="col-md-7">
                    <time>3 - 4 Meses</time>
                    <div>
                        <b>3° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED3 != null"> [[ listsKids.CRED3 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>4° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED4 != null"> [[ listsKids.CRED4 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Antineumo 2:</b>
                        <span class="text-dark" v-if="listsKids.NEUMOCOCICA2 != null"> [[ listsKids.NEUMOCOCICA2 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Rotavirus 2:</b>
                        <span class="text-dark" v-if="listsKids.ROTAVIRUS2 != null"> [[ listsKids.ROTAVIRUS2 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Antipolio 2:</b>
                        <span class="text-dark" v-if="listsKids.ANTIPOLIO2 != null"> [[ listsKids.ANTIPOLIO2 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Pentavalente 2:</b>
                        <span class="text-dark" v-if="listsKids.PENTAVALENTE2 != null"> [[ listsKids.PENTAVALENTE2 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div>
                        <b>Suple 4 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE4 != null"> [[ listsKids.SUPLE4 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #e1efd6;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_5m.png" alt="" width="90">
                </div>
            <div class="col-md-7">
                    <time>5 Meses</time>
                    <div><b>5° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED5 != null"> [[ listsKids.CRED5 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 5 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE5 != null"> [[ listsKids.SUPLE5 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
            </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #e2d2d2;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_6m.png" alt="" width="90">
                </div>
                <div class="col-md-7">
                    <time>6 Meses</time>
                    <div><b>6° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED6 != null"> [[ listsKids.CRED6 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 6 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE6 != null"> [[ listsKids.SUPLE6 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Antipolio 3:</b>
                        <span class="text-dark" v-if="listsKids.ANTIPOLIO3 != null"> [[ listsKids.ANTIPOLIO3 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Pentavalente 3:</b>
                        <span class="text-dark" v-if="listsKids.PENTAVALENTE3 != null"> [[ listsKids.PENTAVALENTE3 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #e6f9f9;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_7m.png" alt="" width="80">
                </div>
                <div class="col-md-7">
                    <time>7 Meses</time>
                    <div><b>7° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED7 != null"> [[ listsKids.CRED7 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 7 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE7 != null"> [[ listsKids.SUPLE7 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #dfd1e2;">
                <div class="col-md-6 text-center">
                    <img src="./img/detalle_ninio/baby_8m.png" alt="" width="110">
                </div>
                <div class="col-md-6 pl-0 pr-0">
                    <time>8 Meses</time>
                    <div><b>8° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED8 != null"> [[ listsKids.CRED8 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 8 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE8 != null"> [[ listsKids.SUPLE8 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #ddb3d0;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_9m.png" alt="" width="85">
                </div>
                <div class="col-md-7">
                    <time>9 Meses</time>
                    <div><b>9° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED9 != null"> [[ listsKids.CRED9 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 9 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE9 != null"> [[ listsKids.SUPLE9 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #f1c8a5;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_10m.png" alt="" width="80">
                </div>
                <div class="col-md-7">
                    <time>10 Meses</time>
                    <div><b>10° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED10 != null"> [[ listsKids.CRED10 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 10 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE10 != null"> [[ listsKids.SUPLE10 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="timelineText d-flex justify-content-center align-items-center" style="background: #d9e2ad;">
                <div class="col-md-5 text-center">
                    <img src="./img/detalle_ninio/baby_11m.png" alt="" width="70">
                </div>
                <div class="col-md-7">
                    <time>11 Meses</time>
                    <div><b>11° Cntrl Mes:</b>
                        <span class="text-dark" v-if="listsKids.CRED11 != null"> [[ listsKids.CRED11 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                    <div><b>Suple 11 Meses:</b>
                        <span class="text-dark" v-if="listsKids.SUPLE11 != null"> [[ listsKids.SUPLE11 ]] </span>
                        <span v-else class="text-danger">Pendiente</span>
                    </div>
                </div>
            </div>
        </li>
        <li></li>
    </ol>
</section>