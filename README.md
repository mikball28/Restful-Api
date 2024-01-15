# ExampleSMS API

Bu proje, VATANSOFT CASE firmasının müşterilerine RESTful API üzerinden SMS gönderimi ve raporlama imkanı sunar.

## Kurulum

1. Proje dosyalarını bilgisayarınıza indirin.
2. `composer install` komutunu çalıştırarak gerekli paketleri yükleyin.
3. `.env` dosyasını oluşturun ve gerekli veritabanı bağlantı bilgilerinizi ekleyin.
4. `php artisan migrate` komutu ile veritabanını oluşturun.
5. `php artisan serve` komutu ile projeyi başlatın.
6. `php artisan l5-swagger:generate` komutunu kullanarak Swagger UI'ı açın ve API dokümantasyonlarını görüntüleyin.

## Kullanım

- [API Dökümantasyonu ve Swagger UI](http://localhost:8000/api/documentation)
- [Login ve Token Alma](http://localhost:8000/api/login)
- [Register](http://localhost:8000/api/register)
- [SMS Gönderimi](http://localhost:8000/api/send-sms)
- [Raporları Görüntüleme](http://localhost:8000/api/sms-reports)
- [Rapor Detayları](http://localhost:8000/api/sms-reports/{id})

## Tarih Filtreleme

Raporları tarih aralığına göre filtrelemek için isteğinizi şu şekilde yapabilirsiniz:

API'yi kullanarak SMS raporlarını tarih aralığına göre filtreleyebilirsiniz. İlgili API endpoint'ini kullanarak istek gönderirken aşağıdaki parametreleri kullanmalısınız:

- `start_date`: Filtreleme aralığının başlangıç tarihi (format: Y-m-d).
- `end_date`: Filtreleme aralığının bitiş tarihi (format: Y-m-d).

Örnek Kullanım:

```bash
curl -X GET "http://localhost:8000/api/sms-reports-filter?start_date=2024-01-01&end_date=2024-01-10" -H "Authorization: Bearer {token}"

