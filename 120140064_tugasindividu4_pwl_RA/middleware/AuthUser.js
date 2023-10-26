import User from "../models/UserModel.js";
import jwt from "jsonwebtoken";
// const jwt = <any>__jwt;
export const verifyUser = async (req, res, next) => {
    if (req.headers.authorization) {
        var access_token = req.headers.authorization;
        access_token = access_token.replace('Bearer ', '');
        var decoded = jwt.verify(access_token, 'ical');
        const user = await User.findOne({
            where: {
                id: decoded.id
            }
        });
        if (!user) return res.status(404).json({ msg: "User tidak ditemukan" });
        // if(user.role !== "admin") return res.status(403).json({msg: "Akses terlarang"});
        req.userId = user.id;
        req.role = user.role;
        // return res.status(401).json({msg: req.headers.authorization});
        // next();
    } else {
        if (!req.session.userId) {
            return res.status(401).json({ msg: "Mohon login ke akun Anda!" });
        }
        const user = await User.findOne({
            where: {
                uuid: req.session.userId
            }
        });
        if (!user) return res.status(404).json({ msg: "User tidak ditemukan" });
        req.userId = user.id;
        req.role = user.role;
    }
    next();
}

export const adminOnly = async (req, res, next) => {

    if (req.headers.authorization) {
        var access_token = req.headers.authorization;
        access_token = access_token.replace('Bearer ', '');
        var decoded = jwt.verify(access_token, 'ical');
        // return res.status(401).json({msg: decoded});
        const user = await User.findOne({
            where: {
                id: decoded.id
            }
        });
        if (!user) return res.status(404).json({ msg: "User tidak ditemukan" });
        if (user.role !== "admin") return res.status(403).json({ msg: "Akses terlarang" });
        req.userId = user.id;
        req.role = user.role;
    } else {
        const user = await User.findOne({
            where: {
                uuid: req.session.userId
            }
        });
        if (!user) return res.status(404).json({ msg: "User tidak ditemukan" });
        if (user.role !== "admin") return res.status(403).json({ msg: "Akses terlarang" });
    }
    next();
    // return res.status(401).json({msg: user});

}