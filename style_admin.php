<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',Arial,sans-serif;
    background:#f1f5f9;
    color:#0f172a;
}

.admin-sidebar{
    width:270px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:linear-gradient(180deg,#020617,#0f172a);
    color:white;
    padding:25px 20px;
}

.admin-brand{
    font-size:24px;
    font-weight:800;
    margin-bottom:35px;
}

.admin-sidebar a{
    display:flex;
    align-items:center;
    gap:12px;
    color:#cbd5e1;
    text-decoration:none;
    padding:13px 15px;
    border-radius:14px;
    margin-bottom:8px;
    font-weight:500;
}

.admin-sidebar a:hover,
.admin-sidebar a.active{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
}

.admin-content{
    margin-left:270px;
    padding:30px;
}

.admin-navbar{
    background:white;
    border-radius:22px;
    padding:22px 28px;
    box-shadow:0 12px 35px rgba(15,23,42,.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}

.stat-card{
    border-radius:24px;
    padding:26px;
    color:white;
    min-height:150px;
    box-shadow:0 15px 35px rgba(15,23,42,.15);
    position:relative;
    overflow:hidden;
}

.stat-card::after{
    content:"";
    position:absolute;
    width:130px;
    height:130px;
    border-radius:50%;
    background:rgba(255,255,255,.15);
    right:-35px;
    top:-35px;
}

.stat-card h5{
    font-size:17px;
    opacity:.95;
}

.stat-card h2{
    font-size:42px;
    font-weight:800;
}

.card-panel{
    background:white;
    border-radius:24px;
    padding:28px;
    box-shadow:0 12px 35px rgba(15,23,42,.08);
    margin-bottom:25px;
}

.quick-card{
    display:block;
    text-decoration:none;
    color:#0f172a;
    background:white;
    border-radius:22px;
    padding:25px;
    box-shadow:0 12px 35px rgba(15,23,42,.08);
    transition:.25s;
    height:100%;
}

.quick-card:hover{
    transform:translateY(-5px);
    color:#2563eb;
}

.quick-card i{
    font-size:35px;
    margin-bottom:12px;
}

.table{
    vertical-align:middle;
}

.badge{
    padding:7px 12px;
    border-radius:10px;
}

@media(max-width:768px){
    .admin-sidebar{
        position:relative;
        width:100%;
        height:auto;
    }

    .admin-content{
        margin-left:0;
        padding:18px;
    }

    .admin-navbar{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }
}
</style>