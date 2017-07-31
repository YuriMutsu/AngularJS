package service;

import com.mongodb.MongoClient;
import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import models.DienKe;
import ninja.Result;
import ninja.Results;
import ninja.params.Param;
import org.bson.Document;

import static util.Constant.*;

public class HoaDonService extends DatabaseUtility{
    public Result getHoaDon(@Param("makh") String makh,
                            @Param("madk") String madk,
                            @Param("mathang") String mathang,
                            @Param("manam") String manam){

        MongoClient client = new MongoClient();
        MongoCollection khachhang = db.getCollection(TABLE_KHACH_HANG);
        Document docKhachHang = (Document) khachhang.find(new Document(MA_KH, makh)).first();

        MongoCollection dienke = db.getCollection(TABLE_DIEN_KE);
        Document docDienKe = (Document) dienke.find(new Document(MA_DK, madk)).first();

        MongoCollection thang = db.getCollection(TABLE_THANG);
        Document docThang = (Document) thang.find(new Document(MA_THANG, mathang)).first();

        MongoCollection nam = db.getCollection(TABLE_NAM);
        Document docNam = (Document) nam.find(new Document(MA_NAM, manam)).first();

        int vat = 10;
        double thanhtien = DienKe.tinhTien(docDienKe.getInteger(CHI_SO_MOI), docDienKe.getInteger(CHI_SO_CU));
        double thanhtoan = thanhtien*vat/100 + thanhtien;
        String mahd = docKhachHang.getString(MA_KH) +"/"+ docDienKe.getString(MA_DK)+"/"+docThang.getString(MA_THANG)+"/"+docNam.getString(MA_NAM);
        Document hoadon = new Document()
                .append(MA_HD, mahd)
                .append(MA_KH, docKhachHang.getString(MA_KH))
                .append(TEN_KH, docKhachHang.getString(TEN_KH))
                .append(DIA_CHI, docKhachHang.getString(DIA_CHI))
                .append(MA_DK, docDienKe.getString(MA_DK))
                .append(TIEU_THU, docDienKe.getInteger(CHI_SO_MOI) - docDienKe.getInteger(CHI_SO_CU))
                .append(TU_NGAY, docThang.getString(MA_THANG) + "/" + docNam.getString(MA_NAM))
                .append(DEN_NGAY, docThang.getString(MA_THANG) + "/" + docNam.getString(MA_NAM))
                .append(VAT, vat)
                .append(MA_THUE, "XXXXXXXXXXXXXXXXXXXX")
                .append(THANH_TIEN, thanhtien)
                .append(THANH_TOAN, thanhtoan);
        client.close();
        return Results.json().render(hoadon);
    }
}
