import React, { useState } from 'react';

const CreateBanner: React.FC = () => {
    const [bannerName, setBannerName] = useState<string>('');
    const [url, setUrl] = useState<string>('');
    const [image, setImage] = useState<File | null>(null);
    const [imageMobile, setImageMobile] = useState<File | null>(null);
    const [active, setActive] = useState<number>(1);
    const [groupId, setGroupId] = useState<number>(0);
    const [sort, setSort] = useState<number>(0);
    const [slogan, setSlogan] = useState<string>('');
    const [errors, setErrors] = useState<string[]>([]);
    const [successMessage, setSuccessMessage] = useState<string | null>(null);
    const [errorMessage, setErrorMessage] = useState<string | null>(null);

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();
        const formData = new FormData();
        formData.append('banner_name', bannerName);
        formData.append('url', url);
        if (image) formData.append('image', image);
        if (imageMobile) formData.append('image_mobile', imageMobile);
        formData.append('active', active.toString());
        formData.append('group_id', groupId.toString());
        formData.append('sort', sort.toString());
        formData.append('slogan', slogan);

        try {
            const response = await fetch('/api/banner/store', {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();
            if (response.ok) {
                setSuccessMessage(data.success);
                setErrors([]);
            } else {
                setErrors(data.errors);
                setErrorMessage(data.error);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    };

    return (
        <div className="right-column">
            <h2 className="title_page">Thêm Banner</h2>
            {errors.length > 0 && (
                <div className="alert alert-danger">
                    <ul>
                        {errors.map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}
            {successMessage && (
                <div className="alert alert-success">
                    {successMessage}
                </div>
            )}
            {errorMessage && (
                <div className="alert alert-danger">
                    {errorMessage}
                </div>
            )}
            <div className="formcontent">
                <div className="content p-3">
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="banner_name">Tên Banner</label>
                            <input
                                type="text"
                                className="form-control"
                                name="banner_name"
                                required
                                value={bannerName}
                                onChange={(e) => setBannerName(e.target.value)}
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="url">URL</label>
                            <input
                                type="url"
                                className="form-control"
                                name="url"
                                value={url}
                                onChange={(e) => setUrl(e.target.value)}
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="image">Hình Ảnh</label>
                            <input
                                type="file"
                                className="form-control"
                                name="image"
                                accept="image/*"
                                required
                                onChange={(e) => setImage(e.target.files?.[0] || null)}
                            />
                            <small className="form-text text-muted">Chọn hình ảnh cho banner.</small>
                        </div>

                        <div className="form-group">
                            <label htmlFor="image_mobile">Hình Ảnh Mobile</label>
                            <input
                                type="file"
                                className="form-control"
                                name="image_mobile"
                                accept="image/*"
                                required
                                onChange={(e) => setImageMobile(e.target.files?.[0] || null)}
                            />
                            <small className="form-text text-muted">Chọn hình ảnh cho banner trên di động.</small>
                        </div>

                        <div className="form-group">
                            <label htmlFor="active">Trạng Thái</label>
                            <select
                                className="form-control"
                                name="active"
                                value={active}
                                onChange={(e) => setActive(Number(e.target.value))}
                            >
                                <option value="1">Kích hoạt</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                        </div>

                        <div className="form-group">
                            <label htmlFor="group_id">Group ID</label>
                            <input
                                type="number"
                                className="form-control"
                                name="group_id"
                                required
                                value={groupId}
                                onChange={(e) => setGroupId(Number(e.target.value))}
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="sort">Sắp xếp</label>
                            <input
                                type="number"
                                className="form-control"
                                name="sort"
                                required
                                value={sort}
                                onChange={(e) => setSort(Number(e.target.value))}
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="slogan">Slogan</label>
                            <input
                                type="text"
                                className="form-control"
                                name="slogan"
                                value={slogan}
                                onChange={(e) => setSlogan(e.target.value)}
                            />
                        </div>

                        <button type="submit" className="btn btn-success">Thêm Banner</button>
                        <a href="/banner" className="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default CreateBanner;
