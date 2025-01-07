import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Feedback = () => {
    const [isFeedbackActive, setIsFeedbackActive] = useState(false);
    const [comment, setComment] = useState('');
    const [fullName, setFullName] = useState('');
    const [address, setAddress] = useState('');
    const [image, setImage] = useState<File | null>(null);
    const position = 1;
    const order = 1;
    const type = '1';
    const active = true;

    const handleFeedBackClick = (event: any) => {
        event.stopPropagation();
        setIsFeedbackActive(!isFeedbackActive);
    };

    const handleHeaderClick = (event: any) => {
        event.stopPropagation();
    };

    const handleSubmit = async () => {
        const formData = new FormData();
        formData.append('comment', comment);
        formData.append('full_name', fullName);
        formData.append('address', address);
        formData.append('position', position.toString());
        formData.append('order', order.toString());
        formData.append('type', type);
        formData.append('active', JSON.stringify(active));
        if (image) {
            formData.append('image', image);
        }

        try {
            await axios.post('http://127.0.0.1:8000/api/feedback', formData);
        } catch (error) {
            console.error(error);
        }
    };

    useEffect(() => {
        const handleClickOutside = () => {
            setIsFeedbackActive(false);
        };

        document.addEventListener('click', handleClickOutside);
        return () => {
            document.removeEventListener('click', handleClickOutside);
        };
    }, []);

    return (
        <main className="w-full max-w-4xl mt-8">
            <div className="flex flex-col w-full p-4">
                <div className="flex items-center justify-between mb-4">
                    <button onClick={handleFeedBackClick} className={`bg-orange-500 text-white py-2 px-4 rounded self-end`}>
                        Viết đánh giá
                    </button>
                </div>
                <div className="bg-white p-6 rounded-lg shadow-lg" style={{ display: isFeedbackActive ? 'block' : 'none' }} onClick={handleHeaderClick}>
                    <div className="flex justify-between items-center mb-4">
                        <h2 className="text-xl font-bold">Viết đánh giá của bạn ở đây</h2>
                        <button className="text-gray-500"><i className="fas fa-times"></i></button>
                    </div>
                    <textarea
                        className="w-full p-2 border rounded-md mb-4"
                        placeholder="Feedback"
                        value={comment}
                        onChange={(e) => setComment(e.target.value)}
                    />
                    <div className="flex space-x-4 mb-4">
                        <input
                            type="text"
                            placeholder="Full Name"
                            className="w-1/2 p-2 border rounded-md"
                            value={fullName}
                            onChange={(e) => setFullName(e.target.value)}
                        />
                        <input
                            type="text"
                            placeholder="Address"
                            className="w-1/2 p-2 border rounded-md"
                            value={address}
                            onChange={(e) => setAddress(e.target.value)}
                        />
                    </div>
                    <input
                        type="file"
                        onChange={(e) => setImage(e.target.files ? e.target.files[0] : null)}
                        className="bg-green-500 text-white p-2 rounded-md mb-4"
                    />
                    <p className="text-gray-500 text-sm mb-4">- Choose an image: gif, png, jpg, jpeg less than 2MB</p>
                    <button onClick={handleSubmit} className="bg-blue-500 text-white p-2 rounded-md">Submit Feedback</button>
                </div>
            </div>
        </main>
    );
}

export default Feedback;
