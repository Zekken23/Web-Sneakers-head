// Variabel global untuk Peta (map) dan Penanda (marker)
let map;
let marker;
let geocoder;

/**
 * 1. Fungsi Inisialisasi Peta (Dipanggil oleh Google API)
 * Fungsi ini WAJIB ada dan harus bernama 'initMap'
 * (sesuai dengan ?callback=initMap di HTML)
 */
function initMap() {
    // Koordinat default (Malang, seperti sebelumnya)
    const defaultLocation = { lat: -7.9220, lng: 112.5995 };

    // Buat Peta baru
    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLocation,
        zoom: 13,
        // Ini adalah style untuk tema gelap agar cocok dengan website Anda
        styles: [
            { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
            { elementType: 'labels.text.stroke', stylers: [{ color: '#242f3e' }] },
            { elementType: 'labels.text.fill', stylers: [{ color: '#746855' }] },
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{ color: '#263c3f' }]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#6b9a76' }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{ color: '#38414e' }]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{ color: '#212a37' }]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#9ca5b3' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{ color: '#746855' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{ color: '#1f2835' }]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#f3d19c' }]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{ color: '#2f3948' }]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#d59563' }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{ color: '#17263c' }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{ color: '#515c6d' }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{ color: '#17263c' }]
            }
        ]
    });

    // Inisialisasi Geocoder (untuk mengubah alamat jadi koordinat)
    geocoder = new google.maps.Geocoder();

    // Buat marker (pin) awal di lokasi default
    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        title: 'Lokasi Awal'
    });
}

/**
 * 2. Fungsi untuk Geocoding Alamat (Versi Google Maps)
 * Ini TIDAK menggunakan fetch(), tapi menggunakan API Geocoder Google.
 */
function geocodeAddress(address) {
    geocoder.geocode({ 'address': address }, (results, status) => {
        if (status === 'OK') {
            // Jika alamat ditemukan
            const location = results[0].geometry.location;
            
            // Pindahkan peta ke lokasi baru
            map.setCenter(location);
            map.setZoom(17); // Zoom lebih dekat
            
            // Pindahkan marker ke lokasi baru
            marker.setPosition(location);
            marker.setTitle(results[0].formatted_address);

        } else {
            // Jika alamat tidak ditemukan
            alert('Lokasi tidak dapat ditemukan. Coba masukkan alamat yang lebih spesifik.');
            console.warn('Geocode was not successful for the following reason: ' + status);
        }
    });
}

/**
 * 3. Event Listener untuk Tombol dan Form
 * Kita harus menunggu seluruh halaman (termasuk Google Maps) dimuat.
 */
window.addEventListener('load', () => {
    // Pastikan initMap sudah selesai berjalan sebelum menambahkan listener
    // Kita beri jeda sedikit untuk memastikan
    setTimeout(() => {
        const verifyBtn = document.getElementById('verify-address-btn');
        const addressInput = document.getElementById('address');
        const form = document.getElementById('checkout-form');

        // Event Listener untuk Tombol "Tampilkan di Peta"
        if (verifyBtn) {
            verifyBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Mencegah form tersubmit
                
                const address = addressInput.value;
                if (!address) {
                    alert("Silakan masukkan alamat terlebih dahulu.");
                    return;
                }
                
                // Panggil fungsi geocode versi Google
                geocodeAddress(address);
            });
        }

        // Handle submit form utama
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                alert("Pesanan Dibuat! (Logika pembayaran belum diimplementasi)");
            });
        }
    }, 1000); // Jeda 1 detik untuk memastikan peta Google siap
});