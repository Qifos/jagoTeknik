-- SQL Commands to update user_materi_progress table for progress tracking
-- Execute these commands in your database manually

-- Add columns to track material reading and video watching progress
ALTER TABLE `user_materi_progress` ADD COLUMN `content_scrolled_to_bottom` BOOLEAN DEFAULT FALSE AFTER `content_read`;
ALTER TABLE `user_materi_progress` ADD COLUMN `video_watch_percentage` TINYINT DEFAULT 0 AFTER `video_total_duration`;
ALTER TABLE `user_materi_progress` ADD COLUMN `is_completed` BOOLEAN DEFAULT FALSE AFTER `completed_at`;

-- Create index for faster queries
CREATE INDEX `idx_user_materi_completed` ON `user_materi_progress` (`id_user`, `id_matkul`, `is_completed`);
