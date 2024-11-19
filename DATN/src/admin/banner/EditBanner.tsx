// Import necessary libraries
import React, { useState } from 'react';

const EditBanner: React.FC<{ banner: any; errors: any; success: string | null }> = ({ banner, errors, success }) => {
    const [formData, setFormData] = useState({
        banner_name: banner.banner_name || '',
        slogan: banner.slogan || '',
        url: banner.url || '',
        group_id: banner.group_id || '',
        sort: banner.sort || '',
        active: banner.active ? '1' : '0',
    });

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        // Handle form submission logic here
    };

    return (
        <div className="right-column">
            <h2 className="title_page">Chỉnh Sửa Banner</h2>

            {errors && errors.length > 0 && (
                <div className="alert alert-danger">
                    <ul>
                        {errors.map((error: string, index: number) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}

            {success && (
                <div className="alert alert-success">
                    {success}
                </div>
            )}

            <div className="formcontent">
                <div className="content p-3">
                    <form onSubmit={handleSubmit} encType="multipart/form-data">
                        <div className="mb-3">
                            <label htmlFor="banner_name" className="form-label">Tên Banner</label>
                            <input type="text" className="form-control" name="banner_name" value={formData.banner_name} onChange={handleChange} required />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="slogan" className="form-label">Slogan</label>
                            <input type="text" className="form-control" name="slogan" value={formData.slogan} onChange={handleChange} />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="url" className="form-label">URL</label>
                            <input type="url" className="form-control" name="url" value={formData.url} onChange={handleChange} required />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="image" className="form-label">Hình Ảnh</label>
                            <input type="file" className="form-control" name="image" />
                            <img src={`storage/${banner.image}`} alt={banner.banner_name} width="100" className="mt-2" />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="image_mobile" className="form-label">Hình Ảnh Mobile</label>
                            <input type="file" className="form-control" name="image_mobile" />
                            <img src={`storage/${banner.image_mobile}`} alt={`${banner.banner_name} Mobile`} width="100" className="mt-2" />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="active" className="form-label">Trạng Thái</label>
                            <select className="form-select" name="active" value={formData.active} onChange={handleChange}>
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>

                        <div className="mb-3">
                            <label htmlFor="group_id" className="form-label">Group ID</label>
                            <input type="number" className="form-control" name="group_id" value={formData.group_id} onChange={handleChange} />
                        </div>

                        <div className="mb-3">
                            <label htmlFor="sort" className="form-label">Sort</label>
                            <input type="number" className="form-control" name="sort" value={formData.sort} onChange={handleChange} />
                        </div>

                        <button type="submit" className="btn btn-primary">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default EditBanner;
