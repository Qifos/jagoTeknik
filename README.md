# jagoTeknik

<img width="757" height="425" alt="image" src="https://github.com/user-attachments/assets/f77d6d60-9569-4b74-8c2c-8b6413befddd" />

1.	Overall Description
1.1	Product Description 
Mahasiswa teknik sering menghadapi tantangan dalam proses pembelajaran yang kompleks, mulai dari padatnya materi kuliah, jadwal yang berlapis, hingga keterbatasan akses terhadap tutor. Penggunaan akses Jago Teknik sebelumnya masih menimbulkan berbagai kendala, seperti materi dan rekaman kuliah yang tersebar di berbagai platform sehingga sulit diakses secara cepat, jadwal belajar yang tidak terstruktur sehingga sering terjadi benturan kelas maupun keterlambatan hadir, minimnya komunikasi langsung dengan tutor yang membuat mahasiswa enggan bertanya atau berkonsultasi, serta platform pembelajaran yang terpisah sehingga memaksa mahasiswa berpindah aplikasi untuk mengakses materi, jadwal, maupun konsultasi. Kondisi ini menyebabkan mahasiswa kurang efisien dalam mengatur waktu, kesulitan menjaga konsistensi belajar, dan berpotensi menurunkan pemahaman terhadap materi.
Untuk menjawab tantangan tersebut, dikembangkanlah Jago Teknik, sebuah platform terpadu yang dirancang khusus untuk mendukung mahasiswa teknik dalam menghadapi beban kuliah yang padat. Aplikasi ini bertujuan untuk mengonsolidasikan materi perkuliahan dalam satu sistem yang terorganisir, menyediakan penjadwalan cerdas agar mahasiswa dapat mengatur waktu belajar serta menghadiri kelas secara lebih terstruktur, dan memfasilitasi layanan konsultasi dengan tutor secara mudah serta fleksibel. Dengan adanya fitur-fitur ini, Jago Teknik diharapkan dapat memberikan pengalaman belajar yang lebih terarah, praktis, dan kolaboratif.
Pengembangan Jago Teknik juga diharapkan memberikan manfaat nyata bagi mahasiswa. Melalui sistem yang terintegrasi, mahasiswa dapat mengakses materi dan rekaman kuliah dengan cepat tanpa terhambat oleh pencarian di berbagai platform. Selain itu, penjadwalan terpadu membantu mahasiswa menghindari bentrok kelas serta mengatur aktivitas belajar secara lebih efektif melalui pengingat dan pengaturan otomatis. Dengan demikian, Jago Teknik diharapkan dapat menjadi solusi yang meningkatkan efisiensi belajar sekaligus kualitas pemahaman mahasiswa terhadap materi perkuliahan.
1.2	Product Features
1.2.1	Akun Pengguna
1.2.1.1	Login Akun 
Mahasiswa yang sudah terdaftar dapat masuk ke sistem dengan menggunakan email dan kata sandi yang telah dibuat sebelumnya. Proses login memastikan keamanan data pribadi serta memberikan akses ke homepage untuk mengeksplor materi dan fitur yang sesuai dengan akun masing-masing.
1.2.1.2	Daftar Akun
Fitur pendaftaran akun memungkinkan pengguna baru untuk membuat akun dengan mudah. Setelah mengisi data diri yang dibutuhkan, mulai dari nama, email, kode pengaman, hingga biodata pengguna dapat langsung mengakses platform untuk mulai belajar.
1.2.1.3	Edit Profil Akun
Pengguna dapat memperbarui informasi pribadi seperti nama, foto profil, kontak, atau preferensi belajar. Fitur ini membantu menyesuaikan akun sesuai kebutuhan masing-masing mahasiswa.	
1.2.2	Homepage
Sistem menampilkan halaman utama setelah login dengan menu navigasi (Beranda, Kelas, Jadwal, Edit Profil), jadwal kelas yang diambil, daftar kelas baru, rekomendasi kelas, dan berita dari Jagoteknik, memberikan pengalaman pengguna yang efisien dan relevan. 
1.2.3	Akses Materi Pembelajaran 
1.2.3.1	Beli Kelas
Mahasiswa dapat memilih kelas dan/atau mata kuliah yang sesuai dengan kebutuhan belajar mereka. Proses pembelian dilakukan secara online dan setelah berhasil, akses ke materi akan langsung terbuka.
1.2.3.2	Baca Materi
Fitur ini memungkinkan mahasiswa membaca e-modul, artikel, atau dokumen pembelajaran yang tersedia secara digital. Semua materi tersaji dalam format yang mudah dipahami dan bisa diakses kapan saja.
1.2.3.3	Lihat Video Kelas/Materi
Selain materi tertulis, mahasiswa juga bisa menonton rekaman video pembelajaran atau kelas yang sudah berlangsung. Video ini membantu memperdalam pemahaman dan bisa diputar ulang sesuai kebutuhan.
1.2.4	Lihat Jadwal
Mahasiswa dapat melihat jadwal belajar mereka menggunakan sistem kalender interaktif. Fitur ini memudahkan dalam melihat waktu kelas hingga menyesuaikan jadwal sesuai dengan kesibukan masing-masing.
1.2.5	Pilih Tutor
Pengguna dapat memilih tutor yang sesuai dengan bidang keahlian, gaya mengajar, atau ketersediaan waktu mereka.
1.2.6	Live Chat
Mahasiswa dapat melakukan percakapan langsung dengan tutor dan pengguna lain melalui room chat pribadi. Pengguna juga bisa melakukan panggilan suara dan panggilan video. Hal ini mempermudah konsultasi dan memberikan ruang diskusi yang lebih fleksibel untuk membahas materi yang sulit dipahami.

1.3	High-Level Functional Requirements
1.3.1	Akun Pengguna 
1.3.1.1 Login Akun 
•	Sistem harus menyediakan form login (email & password). 
•	Sistem harus menyediakan opsi ingat password.
•	Sistem harus mengecek (memvalidasi) apakah email/username dan password yang dimasukkan sesuai dengan data pengguna yang sudah terdaftar 
•	Sistem harus mengarahkan pengguna ke Dashboard setelah login berhasil.
•	Sistem harus menampilkan pesan kesalahan apabila data login tidak sesuai (Tidak menemukan akun).
1.3.1.2	Daftar Akun
•	Sistem harus menyediakan form daftar yang berisi input (Nama, email, password, verifikasi password, centang persetujuan kebijakan).
•	Sistem harus menyediakan kode OTP di Gmail sesuai email yang didaftarkan.
•	Sistem harus menyimpan data registrasi pengguna ke dalam database akun.
•	Sistem harus mengarahkan pengguna ke halaman pengisian profil setelah daftar berhasil.
•	Sistem harus menyediakan form pengsian profil (Angkatan, tanggal lahir, jurusan, nomor HP).
•	Sistem harus menyimpan data profil ke dalam basis data setelah pengisian profil berhasil.
1.3.1.3	Edit Profil Akun
•	Sistem harus menampilkan halaman profil pengguna yang berisi informasi akun. 
•	Sistem harus menyediakan field yang dapat diubah oleh pengguna.
•	Sistem harus menyimpan data profil terbaru ke dalam basis data setelah pengisian profil berhasil.
•	Sistem harus menyediakan tombol Back untuk kembali ke halaman sebelumnya atau halaman utama.
1.3.1.4	Homepage 
•	Sistem harus menampilkan halaman utama (Home) setelah login.
•	Sistem harus menampilkan menu navigasi utama (Beranda, Kelas, Jadwal, Edit Profil).
•	Sistem harus menampilkan jadwal kelas yang diambil.
•	Sistem harus menampilkan daftar kelas yang baru dibuka/diakses pengguna.
•	Sistem harus menampikan rekomendasi kelas yang cocok untuk pengguna.
1.3.2	Akses Mata Kuliah
1.3.2.1	Akses Kelas
•	Sistem harus menampilkan semua kelas yang terdapat di platform Jago Teknik.
•	Sistem harus menampilkan semua kelas yang diikuti pengguna.
•	Sistem harus menampilkan kelas yang selesai diikuti oleh pengguna.
•	Sistem harus menampilkan wishlist kelas yang diinginkan pengguna.
1.3.2.2	Beli Kelas
•	Sistem harus menyediakan daftar kelas yang dapat dibeli pengguna. 
•	Sistem harus menampilkan overview kelas, rating, benefit, dan harga kelas.
•	Sistem harus menampikan rincian biaya, nama, dan password untuk melakukan konfirmasi pembayaran.
•	Sistem harus menyediakan metode pembayaran yang mendukung transaksi online.
•	Sistem harus memberikan akses ke materi setelah pembayaran berhasil.
•	Sistem harus menyediakan tombol Back untuk kembali ke halaman sebelumnya atau halaman utama.
1.3.2.3	Baca Materi
•	Sistem harus menyediakan halaman untuk membaca materi pembelajaran berbentuk teks.
•	Sistem harus memastikan materi hanya dapat diakses oleh pengguna yang sudah membeli kelas.
•	Sistem harus menyediakan tombol Back untuk kembali ke halaman sebelumnya atau halaman utama.
1.3.2.4	Lihat Video Kelas/Materi
•	Sistem harus menampilkan video yang dapat diakses 
•	Sistem harus menyediakan fitur pemutaran video materi di dalam aplikasi. 
•	Sistem harus memastikan video hanya dapat diakses oleh pengguna yang sudah membeli kelas.
•	Sistem harus menyediakan tombol Back untuk kembali ke halaman sebelumnya atau halaman utama.
1.3.3 Lihat Jadwal
•	Sistem harus memapilkan fitur kalender atau jadwal belajar sesuai dengan hari yang dipilih.
•	Sistem harus menampilkan jadwal kelas terdekat.
•	Sistem harus menampilkan semua jadwal yang akan datang.
•	Sistem harus menyediakan tombol Back untuk kembali ke halaman sebelumnya atau halaman utama.
1.3.4	Live Chat Tutor
•	Sistem harus menyediakan fitur percakapan antara pengguna dan tutor. 
•	Sistem harus mendukung pengiriman teks dan media berupa file atau gambar untuk mendukung konsultasi.
•	Sistem harus menyimpan riwayat percakapan agar dapat dilihat kembali oleh pengguna.
•	Sistem harus memastikan keamanan dan privasi data percakapan.

